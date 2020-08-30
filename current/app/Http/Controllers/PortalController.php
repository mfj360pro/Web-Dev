<?php

namespace App\Http\Controllers;

use Session;
use DB;
use File;
use Response;
use Mail;
use Hash;
use Validator;
use View;
use App\Account;
use App\Breakdown;
use App\Pricing;
use App\Quotation;
use App\Service;
use App\Status;
use App\Unit;
use App\User;
use App\Zipcode;
use App\Mail\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\LazyCollection;
use Intervention\Image\Facades\Image;

class PortalController extends WebService
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if(Session::has('app_customer_id')) {
                $data = json_decode($this->ReadAccount(new Request(['id' => Session::get('app_customer_id')])), true);
                View::share('data', $data);
                View::share('menus', json_decode($this->ReadMenusByRole(new Request(['role_id' => 4])), true));
                View::share('accesstype', 'portal');
                View::share('accessname', 'Customer Portal');
                View::share('dashboard_msg', 'You have successfully logged in to the customer portal.');
                return $next($request);
            }
            else return redirect(action('LoginController@CustomerLogin'));
        });
    }
    public function Breakdowns(Request $request) {
        
        $quotation      = json_decode($this->ReadQuotation($request), true);
        $breakdown      = json_decode($this->ReadBreakdown($request), true);
        $contributors   = json_decode($this->ReadQuotationContributors($request), true);
        $uploads        = json_decode($this->ReadUploadsByQuotation($request), true);
        $customer       = json_decode($this->ReadQuotedCustomer($request), true);
        $services       = json_decode($this->ReadServices(), true);
        $pricings       = json_decode($this->ReadPricing($request), true);
        $units          = json_decode($this->ReadUnits(), true);
        $zipcodes       = json_decode($this->ReadZipcodes(), true);

        return view('portal.pages.details',
            compact('quotation', 'breakdown', 'contributors', 'uploads', 'services', 'customer', 'pricings', 'units', 'zipcodes'));

    }
    public function CreateQuotation(Request $request) {

        try {

            //Gather tables
            $customer       = Account::with('promos')->find(Session::get('app_customer_id'));
            $status         = Status::where('name', 'unverified')->first();
            $zipcode        = Zipcode::where('zipcode', $request->zipcode)->first();
            $password       = str_random(8);

            // Create new Quotation
            $quotation = new Quotation;
            $quotation->title           = $request->address;
            $quotation->customer_id     = $customer->id;
            $quotation->address         = $request->address;
            $quotation->zipcode_id      = $zipcode->id;
            $quotation->notes           = $request->notes;
            $quotation->current_status  = 1;
            $quotation->start_date      = $request->start_date;
            // $quotation->end_date     = $request->end_date;
            $quotation->notes           = $request->notes;
            $quotation->save();

            foreach($request->service_quantity as $sq => $values) {

                $pricing = Pricing::find($values['service_id']);
                
                $breakdown = new Breakdown;
                $breakdown->quotation_id = $quotation->id;
                $breakdown->service      = $pricing->service->title;
                $breakdown->package      = '$'.$pricing->price.' per '.$pricing->unit->name;
                $breakdown->quantity     = $values['quantity'];
                $breakdown->total        = round($pricing->price * $values['quantity']);

                $breakdown->save();

            }

            $breakdown = new Breakdown;
            $breakdown->quotation_id = $quotation->id;
            $breakdown->service      = 'On Site Fee';
            $breakdown->package      = '--';
            $breakdown->quantity     = 1;
            $breakdown->total        = $zipcode->fee;

            $breakdown->save();

            $data = [
                'name'  => $customer->firstname . ' ' . $customer->lastname,
                'email' => $customer->email,
                'view'  => 'common.email.notify_old_customer'
            ];

            // Send the email
            Mail::send(new Notification($data));

            return json_encode([
                'code' => 1,
                'data' => $customer
            ]);

            // return json_encode($customer);

        } catch (\Throwable $th) {
            
            return json_encode([
                'code'      => 0,
                'message'   => 'An error occured while submitting your request.'
            ]);

        }

    }
    public function Dashboard() {
        return view('backend.pages.dashboard');
    }
    public function GetQuote(Request $request) {
        $promos = json_decode($this->ReadCustomerPromos(new Request(['id'=> Session::get('app_customer_id')])), true);
        return view('portal.pages.get-a-quote', compact('promos'));
    }
    public function Preview(Request $request) {
        $quotation  = json_decode($this->ReadQuotation($request), true);
        $breakdown  = json_decode($this->ReadBreakdown($request), true);
        $customer   = json_decode($this->ReadQuotedCustomer($request), true);
        $services   = json_decode($this->ReadServices(), true);
        $pricings   = json_decode($this->ReadPricing($request), true);
        $units      = json_decode($this->ReadUnits(), true);
        $zipcodes   = json_decode($this->ReadZipcodes(), true);
        return view('portal.pages.preview', 
            compact('quotation', 'breakdown', 'services', 'customer', 'pricings', 'units', 'zipcodes'));
    }
    public function Promos() {
        return view('portal.pages.promos');
    }
    public function Quotations() {
        $services   = json_decode($this->ReadServices(), true);
        $customers  = json_decode($this->ReadCustomers(), true);
        $zipcodes   = json_decode($this->ReadZipcodes(), true);
        $status     = json_decode($this->ReadStatus(), true);
        $promos     = json_decode($this->ReadCustomerPromos(new Request(['id'=> Session::get('app_customer_id')])), true);
        return view('portal.pages.quotations', 
            compact('services', 'customers', 'zipcodes', 'status', 'promos'));
    }
    public function Profile() {
        return view('portal.pages.profile');
    }
}
