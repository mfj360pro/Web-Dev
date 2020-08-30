<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Validator;
use App\Mail\Notification;
use App\Mail\Subscriber;

class MailController extends Controller
{
    public function ValidateEmail(Request $request) {
        $result = null;
        $result =
            Validator::make($request->all(), [
                'email' => 'required|email|max:255',
                'fullname' => 'required|max:255',
                'message' => 'required|max:255'
            ]);

        if($result->fails()) {
            return json_encode(array("status_code" => 0, "status" => "text-danger", "message" => $result->errors()));
        }
        else {
            return json_encode(array("status_code" => 1, "status" => "text-success", "message" => "We have received your email and will get back to you shortly!"));
        }

    }
    public function SendEmail(Request $request) {    
        Mail::send(new Subscriber($request));
    }
    public function SendNotification(Request $request) {
        Mail::send(new Notification($request));
    }
}
