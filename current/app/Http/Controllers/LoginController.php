<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;

class LoginController extends WebService
{
    // ADMINISTRATORS / USERS
    public function AdminLogin() {
        if(Session::has('app_account_id')) {
            return redirect(action('AdminController@Dashboard'));
        }
        else {
            $message = [
                'title'         => 'Administrator Login',
                'welcome'       => 'Welcome to the Admin Portal!',
                'description'   => 'Please login your account.',
                'access'        => 'admin'
            ];
            return view('backend.pages.login', compact('message'));
        }
    }
    public function AdminSignIn(Request $request) {
        $result = json_decode($this->SignInAdmin($request), true);
        if(count($result) > 0) {
            Session::put('app_account_id', $result['id']);
            return redirect(action('AdminController@Dashboard'));
        }
        else {
            return redirect(action('LoginController@AdminLogin'));
        }
    }
    public function AdminSignOut() {
        Session::forget('app_account_id');
        return redirect(action('LoginController@AdminLogin'));
    }
    
    // PHOTOGRAPHERS
    public function PhotographerLogin() {
        if(Session::has('app_photographer_id')) {
            return redirect(action('PhotographerController@Dashboard'));
        }
        else {
            $message = [
                'title'         => 'Photographer Login',
                'welcome'       => 'Welcome to the Photographers Portal!',
                'description'   => 'Please login your account.',
                'access'        => 'photographer'
            ];
            return view('backend.pages.login', compact('message'));
        }
    }
    public function PhotographerSignIn(Request $request) {
        $result = json_decode($this->SignInPhotographer($request), true);
        if(count($result) > 0) {
            Session::put('app_photographer_id',     $result['id']);
            return redirect(action('PhotographerController@Dashboard'));
        }
        else {
            return redirect(action('LoginController@PhotographerLogin'));
        }
    }
    public function PhotographerSignOut() {
        Session::forget('app_photographer_id');
        return redirect(action('LoginController@PhotographerLogin'));
    }

    // CUSTOMERS
    public function CustomerLogin() {
        if(Session::has('app_customer_id')) {
            return redirect(action('PortalController@Dashboard'));
        }
        else {
            $message = [
                'title'         => 'Customer Portal',
                'welcome'       => 'Welcome to the Customer Portal!',
                'description'   => 'Please login your account.',
                'access'        => 'portal'
            ];
            return view('backend.pages.login', compact('message'));
        }
    }
    public function CustomerSignIn(Request $request) {
        $result = json_decode($this->SignInCustomer($request), true);
        if(count($result) > 0) {
            Session::put('app_customer_id', $result['id']);
            return redirect(action('PortalController@Dashboard'));
        }
        else {
            return redirect(action('LoginController@CustomerLogin'));
        }
    }
    public function CustomerSignOut() {
        Session::forget('app_customer_id');
        return redirect(action('LoginController@CustomerLogin'));
    }
    
    // DESIGNER
    public function DesignerLogin() {
        if(Session::has('app_designer_id')) {
            return redirect(action('DesignerController@Dashboard'));
        }
        else {
            $message = [
                'title'         => 'Designer Portal',
                'welcome'       => 'Welcome to the Designer Portal!',
                'description'   => 'Please login your account.',
                'access'        => 'designer'
            ];
            return view('backend.pages.login', compact('message'));
        }
    }
    public function DesignerSignIn(Request $request) {
        $result = json_decode($this->SignInDesigner($request), true);
        if(count($result) > 0) {
            Session::put('app_designer_id', $result['id']);
            return redirect(action('DesignerController@Dashboard'));
        }
        else {
            return redirect(action('LoginController@DesignerLogin'));
        }
    }
    public function DesignerSignOut() {
        Session::forget('app_designer_id');
        return redirect(action('LoginController@DesignerLogin'));
    }
    
    // EDITOR
    public function EditorLogin() {
        if(Session::has('app_editor_id')) {
            return redirect(action('EditorController@Dashboard'));
        }
        else {
            $message = [
                'title'         => 'Editor Portal',
                'welcome'       => 'Welcome to the Editor Portal!',
                'description'   => 'Please login your account.',
                'access'        => 'editor'
            ];
            return view('backend.pages.login', compact('message'));
        }
    }
    public function EditorSignIn(Request $request) {
        $result = json_decode($this->SignInEditor($request), true);
        if(count($result) > 0) {
            Session::put('app_editor_id', $result['id']);
            return redirect(action('EditorController@Dashboard'));
        }
        else {
            return redirect(action('LoginController@EditorLogin'));
        }
    }
    public function EditorSignOut() {
        Session::forget('app_editor_id');
        return redirect(action('LoginController@EditorLogin'));
    }
    
}
