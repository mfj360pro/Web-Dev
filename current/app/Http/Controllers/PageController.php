<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends WebService
{
    public function Home() {
        $services = json_decode($this->ReadServices(), true);
        return view('common.home', compact('services'));
    }
    public function ContactUs() {
        return view('common.contactus');
    }
    public function Career() {
        return view('common.career');
    }

    public function GetQuote() {
        return view('common.get-a-quote');
    }
    public function Quote(Request $request) {
        $pricings = json_decode($this->ReadPricingByService($request), true);
        $service  = json_decode($this->ReadServiceById($request), true);
        $zipcodes = json_decode($this->ReadZipcodes(), true);
        $units    = json_decode($this->ReadUnits(), true);
        return view('common.quote', compact('service', 'pricings', 'zipcodes', 'units'));
    }
    public function Services(Request $request) {
        $data = json_decode($this->ReadServiceById($request), true);
        return view('common.services', compact('data'));
    }
    public function Applications(Request $request) {
        $data = [];
        if($request['type'] == 'photographer') {
            $data = [
                'title'         => 'Photographer Application',
            ];
        }

        if($request['type'] == 'partnership') {
            $data = [
                'title'         => 'Partnership Application',
            ];
        }
        if($request['type'] == 'Graphic-Designer') {
            $data = [
                'title'         => 'Graphic Designer Application',
            ];
        }


        return view('common.applications', compact('data'));
    }

}
