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
use App\Service;
use App\Quotation;
use App\Customer;
use App\Breakdown;
use App\Unit;
use App\Zipcode;
use App\Pricing;
use App\User;
use App\Status;
use App\Mail\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\LazyCollection;
use Intervention\Image\Facades\Image;

class DesignerController extends WebService
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if(Session::has('app_designer_id')) {
                $data = json_decode($this->ReadAccount(new Request(['id' => Session::get('app_designer_id')])), true);
                View::share('data', $data);
                View::share('menus', json_decode($this->ReadMenusByRole(new Request(['role_id' => 6])), true));
                View::share('accesstype', 'designer');
                View::share('accessname', 'Designer Portal');
                View::share('dashboard_msg', 'You have successfully logged in to the designers panel.');
                return $next($request);
            }
            else return redirect(action('LoginController@DesignerLogin'));
        });
    }
    public function Dashboard() {
        return view('backend.pages.dashboard');
    }
    public function Details(Request $request) {
        $quotation      = json_decode($this->ReadQuotation($request), true);
        $breakdown      = json_decode($this->ReadBreakdown($request), true);
        $contributors   = json_decode($this->ReadQuotationContributors($request), true);
        $uploads        = json_decode($this->ReadUploadsByQuotation($request), true);
        $customer       = json_decode($this->ReadQuotedCustomer($request), true);
        $services       = json_decode($this->ReadServices(), true);
        $pricings       = json_decode($this->ReadPricing($request), true);
        $units          = json_decode($this->ReadUnits(), true);
        $zipcodes       = json_decode($this->ReadZipcodes(), true);
        return view('designer.pages.details', 
            compact('quotation', 'breakdown', 'contributors', 'uploads', 'services', 'customer', 'pricings', 'units', 'zipcodes'));
    }
    public function Quotations() {
        $this->LogPhotographer('quotations');
        $services   = json_decode($this->ReadServices(), true);
        $customers  = json_decode($this->ReadCustomers(), true);
        $zipcodes   = json_decode($this->ReadZipcodes(), true);
        $status     = json_decode($this->ReadStatus(), true);
        return view('designer.pages.quotations', 
            compact('services', 'customers', 'zipcodes', 'status'));
    }
}
