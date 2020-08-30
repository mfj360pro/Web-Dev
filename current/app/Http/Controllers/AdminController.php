<?php

namespace App\Http\Controllers;

use Session;
use View;
use Illuminate\Http\Request;

class AdminController extends WebService
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Session::has('app_account_id')) {
                $data = json_decode($this->ReadAccount(new Request(['id' => Session::get('app_account_id')])), true);
                View::share('data', $data);
                View::share('menus', json_decode($this->ReadMenusByRole(new Request(['role_id' => 1])), true));
                View::share('accesstype', 'admin');
                View::share('accessname', 'Administration');
                View::share('dashboard_msg', 'You have successfully logged in to the admin panel.');
                return $next($request);
            }
            else return redirect(action('LoginController@AdminLogin'));
        });
    }
    public function Accounts() {
        return view('admin.pages.accounts',
        [
            'roles' => json_decode($this->ReadRoles(), true)
        ]);
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
        return view('admin.pages.details', 
            compact('quotation', 'breakdown', 'contributors', 'uploads', 'services', 'customer', 'pricings', 'units', 'zipcodes'));
    }
    public function Contents() {
        return view('admin.pages.contents');
    }
    public function Customers() {
        $zipcodes   = json_decode($this->ReadZipcodes(), true);
        return view('admin.pages.customers', compact('zipcodes'));
    }
    public function Dashboard() {
        return view('backend.pages.dashboard');
    }
    public function Photographers() {
        $zipcodes   = json_decode($this->ReadZipcodes(), true);
        return view('admin.pages.photographers', compact('zipcodes'));
    }
    public function Pricing() {
        $services   = json_decode($this->ReadServices(), true);
        $units      = json_decode($this->ReadUnits(), true);
        $zipcodes   = json_decode($this->ReadZipcodes(), true);
        return view('admin.pages.pricing', compact('services', 'units', 'zipcodes'));
    }
    public function Promos() {
        return view('admin.pages.promos');
    }
    public function Quotations() {
        $this->LogAccount('quotations');
        $services   = json_decode($this->ReadServices(), true);
        $customers  = json_decode($this->ReadCustomers(), true);
        $zipcodes   = json_decode($this->ReadZipcodes(), true);
        $status     = json_decode($this->ReadStatus(), true);
        return view('admin.pages.quotations', compact('services', 'customers', 'zipcodes', 'status'));
    }
    public function Services() {
        return view('admin.pages.services');
    }
    public function Status() {
        return view('admin.pages.status');
    }
    public function Units() {
        return view('admin.pages.units');
    }
    public function Uploader() {
        return view('admin.pages.uploader');
    }
    public function Zipcodes() {
        return view('admin.pages.zipcodes');
    }

}
