<?php

namespace App\Http\Controllers;

use Session;
use DB;
use File;
use Response;
use Hash;
use Validator;
use App\Account;
use App\AccountRole;
use App\Breakdown;
use App\Pricing;
use App\Quotation;
use App\Service;
use App\Status;
use App\Unit;
use App\User;
use App\Zipcode;
use Mail;
use App\Mail\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\LazyCollection;
use Intervention\Image\Facades\Image;

class QuoteController extends WebService
{
    public function ValidateQuotation(Request $request) {
        $result = 0;
        $success_message = '';
        if($request->step == 1)
            $result =
                Validator::make($request->all(), [
                    'address'       => 'required|max:255'
                ]);
        if($request->step == 2)
            $result =
                Validator::make($request->all(), [
                    'quantity'      => 'required|max:255'
                ]);
        if($request->step == 3) {
            // none
        }
        if($request->step == 4) {
            $result =
                Validator::make($request->all(), [
                    'email'         => 'required|email|max:255',
                    'firstname'     => 'required|max:255',
                    'lastname'      => 'required|max:255',
                    'phone'         => 'required|max:255'
                ]);            
            $success_message = "We have received your quotation! Please check your email for verification.";
        }
        if($result->fails()) {
            return json_encode(array("status_code" => 0, "status" => "text-danger", "message" => $result->errors()));
        }
        else {
            return json_encode(array("status_code" => 1, "status" => "text-success", "message" => $success_message));
        }
    }
    public function SearchServices(Request $request) {
        $zipcode = Zipcode::where('zipcode', $request->zipcode)->first();
        if($zipcode!=null)
            return json_encode(
                Pricing::where('zipcode_id', $zipcode->id)->with('service')->with('unit')->with('zipcode')->get()
            );
        else return json_encode([]);
    }
    public function CreateQuotation(Request $request) {
        try {

            // Gather Tables
            $account        = Account::where('email', $request->email)->first();
            $zipcode        = Zipcode::where('zipcode', $request->zipcode)->first();
            $password       = str_random(8);
            $newCustomer    = false;

            // Check if Customer Exists
            if ($account == null) {

                // if Customer does not exist, generate password and create a customer account
                $newCustomer = true;
                
                $account = new Account;
                $account->firstname    = $request->firstname;
                $account->lastname     = $request->lastname;
                $account->phone        = $request->phone;
                $account->email        = $request->email;
                $account->password     = $this->EncryptPassword($password);
                $account->save();

            }

            $account_role = AccountRole::where('account_id', $account->id)->where('role_id', 4)->first();
            if($account_role == null) {
                $account_role               = new AccountRole;
                $account_role->account_id   = $account->id;
                $account_role->role_id      = 4;
                $account_role->save();
            }

            // Create new Quotation
            $quotation                  = new Quotation;
            $quotation->title           = $request->address;
            $quotation->customer_id     = $account->id;
            $quotation->current_status  = 1;
            $quotation->zipcode_id      = $zipcode->id;
            $quotation->address         = $request->address;
            $quotation->notes           = $request->notes;
            $quotation->start_date      = $request->start_date;
            // $quotation->end_date     = $request->end_date;
            $quotation->notes           = $request->notes;
            $quotation->save();

            foreach($request->service_quantity as $sq => $values) {
                
                $pricing   = Pricing::find($values['service_id']);

                $breakdown = new Breakdown;
                $breakdown->quotation_id = $quotation->id;
                $breakdown->service      = $pricing->service->title;
                $breakdown->service_id   = $pricing->service->id;
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

            if($newCustomer)
                $data = [
                    'name'      => $customer->firstname . ' ' . $customer->lastname,
                    'email'     => $customer->email,
                    'password'  => $password,
                    'view'      => 'common.email.notify_new_customer'
                ];
            else
                $data = [
                    'name'  => $customer->firstname . ' ' . $customer->lastname,
                    'email' => $customer->email,
                    'view'  => 'common.email.notify_old_customer'
                ];

            // Send the email
            Mail::send(new Notification($data));

            return json_encode('success');

        } catch (\Throwable $th) {
            return json_encode('error');
        }

    }
}
