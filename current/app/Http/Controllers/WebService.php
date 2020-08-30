<?php

namespace App\Http\Controllers;


use Session;
use DB;
use File;
use Response;
use Hash;
use Mail;
use Validator;
use App\Account;
use App\AccountPromo;
use App\AccountRole;
use App\AccountQuotation;
use App\AccountZipcode;
use App\Breakdown;
use App\Promo;
use App\Content;
use App\Log;
use App\Mail\Notification;
use App\Menu;
use App\MenuRole;
use App\Pricing;
use App\Quotation;
use App\Role;
use App\Service;
use App\Status;
use App\Type;
use App\Unit;
use App\Upload;
use App\Zipcode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\LazyCollection;
use Intervention\Image\Facades\Image;

class WebService extends WebServiceHelper {

    //=============================================================

    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         return $next($request);
    //     });
    // }

    //=============================================================
    
    // SIGN IN
    public function SignInAdmin(Request $request) {

        $data = Account::where('email', $request->email)->first();
        if($data<>null) {
            $roles = AccountRole::where('account_id', $data->id)->whereIn('role_id', [1, 2, 3])->get();
            if($roles<>null) 
                if(Hash::check($this->AddSalt($request->password), $data->password))
                    return json_encode($data);
        }

        return $this->ThrowResponse(0, 'An error occurred when logging into your account.');

    }
    public function SignInCustomer(Request $request) {

        $data = Account::where('email', $request->email)->first();
        if($data<>null) {
            $roles = AccountRole::where('account_id', $data->id)->whereIn('role_id', [4])->get();
            if($roles<>null) 
                if(Hash::check($this->AddSalt($request->password), $data->password))
                    return json_encode($data);
        }

        return $this->ThrowResponse(0, 'An error occurred when logging into your account.');

    }
    public function SignInDesigner(Request $request) {

        $data = Account::where('email', $request->email)->first();
        if($data<>null) {
            $roles = AccountRole::where('account_id', $data->id)->whereIn('role_id', [6])->get();
            if($roles<>null) 
                if(Hash::check($this->AddSalt($request->password), $data->password))
                    return json_encode($data);
        }

        return $this->ThrowResponse(0, 'An error occurred when logging into your account.');

    }
    public function SignInEditor(Request $request) {

        $data = Account::where('email', $request->email)->first();
        if($data<>null) {
            $roles = AccountRole::where('account_id', $data->id)->whereIn('role_id', [6])->get();
            if($roles<>null) 
                if(Hash::check($this->AddSalt($request->password), $data->password))
                    return json_encode($data);
        }

        return $this->ThrowResponse(0, 'An error occurred when logging into your account.');

    }
    public function SignInPhotographer(Request $request) {

        $data = Account::where('email', $request->email)->first();
        if($data<>null) {
            $roles = AccountRole::where('account_id', $data->id)->whereIn('role_id', [5])->get();
            if($roles<>null) 
                if(Hash::check($this->AddSalt($request->password), $data->password))
                    return json_encode($data);
        }
        
        return $this->ThrowResponse(0, 'An error occurred when logging into your account.');

    }

    //=============================================================
    
    // ACCOUNTS
    public function ReadAccounts() {
        return json_encode(Account::with('roles')->get());
    }
    public function ReadAccount(Request $request) {
        return json_encode(Account::with('roles')->find($request->id));
    }
    public function UpdateAccountInfo(Request $request) {
        
        $data = Account::where('id', '<>', $request->id)->where('email', $request->email)->first();

        if($data!=null) return $this->ThrowResponse(0, 'This email is already registered. Please provide another email.'); 
        
        $validator = 
            Validator::make($request->all(), [
                'password' => 'required|max:255'
            ]);

        $data = Account::find($request->id);
            
        if(!$validator->fails()) $data->password = $this->EncryptPassword($request->password);
        
        $data->firstname    = $request->firstname;
        $data->lastname     = $request->lastname;
        $data->email        = $request->email;
        $data->phone        = $request->phone;
        $data->address      = $request->address;

        if($request->file('avatar')) {
            if(!$data->avatar == null) $this->DeleteFile($data->avatar);
            $data->avatar = ($this->UploadFile($request->file('avatar')))[0];
        }

        $data->save();

        return back();

        // return $this->ThrowResponse(1, 'Success.');

    }
    public function UpdateCompanyInfo(Request $request) {

        $data = Account::find($request->id);
        $data->company_name     = $request->company_name;
        $data->company_slogan   = $request->company_slogan;
        $data->company_address  = $request->company_address;
        
        if($request->file('company_logo')) {
            if(!$data->company_logo == null) $this->DeleteFile($data->company_logo);
            $data->company_logo = ($this->UploadFile($request->file('company_logo')))[0];
        }

        $data->save();

        return back();

        // return $this->ThrowResponse(1, 'Success.');

    }
    public function UpsertAccount(Request $request) {

        $validator = 
            Validator::make($request->all(), [
                'password' => 'required|max:255'
            ]);

        $data = Account::where('id', '<>', $request->id)->where('email', $request->email)->first();
        if($data<>null) return $this->ThrowResponse(0, 'This email is already registered. Please provide another email.'); 
        
        $data = Account::find($request->id);
        if($data==null) {
            $data = new Account;
            if($validator->fails()) return $this->ThrowResponse(0, 'Please provide a password.');
            else $data->password = $this->EncryptPassword($request->password);
        }
        else 
            if(!$validator->fails()) $data->password = $this->EncryptPassword($request->password);
        
        $data->firstname    = $request->firstname;
        $data->lastname     = $request->lastname;
        $data->email        = $request->email;
        $data->phone        = $request->phone;
        $data->save();

        if(count($request->roles) > 0) {
            AccountRole::where('account_id', $data->id)->delete();
            foreach ($request->roles as $key => $role) {
                $account_role               = new AccountRole;
                $account_role->account_id   = $data->id;
                $account_role->role_id      = $role;
                $account_role->save();
            }
        }

        return $this->ThrowResponse(1, 'Success.'); 

    }
    public function DeleteAccount(Request $request) {
        $data = Account::find($request->id);
        $data->delete();
        return $this->ThrowResponse(1, 'Deleted.');
    }
    
    // BREAKDOWNS
    public function ReadBreakdown(Request $request) {
        return json_encode(Quotation::find($request->id)->breakdowns);
    }
    public function UpsertBreakdown(Request $request) {

        $data = Breakdown::find($request->id);
        
        if($data==null) $data = new Breakdown;

        $service = Service::find($request->service_id);
        $pricing = Pricing::find($request->pricing_id);
        $unit    = Pricing::find($request->pricing_id)->unit->name;
        $zipcode = Pricing::find($request->pricing_id)->zipcode->zipcode;
        
        $data->quotation_id = $request->quotation_id;
        $data->service_id   = $service->id;
        $data->service      = $service->title;
        $data->package      = '$'.$pricing->price.' per '.$unit;
        $data->quantity     = $request->quantity;
        $data->total        = round($pricing->price * $request->quantity);

        $data->save();

        return $this->ThrowResponse(1, 'Success.');

    }
    public function DeleteBreakdown(Request $request) {
        $data = Breakdown::find($request->id);
        $data->delete();
        return $this->ThrowResponse(1, 'Deleted.');
    }
    public function DeleteBreakdowns($quotation_id) {
        $data = Breakdown::where('quotation_id', $quotation_id);
        $data->delete();
        return $this->ThrowResponse(1, 'Deleted.');
    }
    
    // CONTENT
    public function ReadContents() {
        return json_encode(Content::all());
    }
    public function UpsertContent(Request $request) {
        
        $content = Content::find($request->id);

        if($content==null) $content = new Content;
                
        $content->element   = $request['element'];
        $content->value     = $request['value'];

        if($request->file('cover')) {
            $content->value = ($this->UploadFile($request->file('cover')))[0];
        }

        $content->save();
        
        return back();

    }
    public function DeleteContent(Request $request) {
        $data = Content::find($request->id);
        $data->delete();
        return $this->ThrowResponse(1, 'Deleted.');
    }

    // CUSTOMERS
    public function ReadCustomers() {
        return json_encode(Role::find(4)->accounts);
    }

    // CUSTOMER PROMO
    public function ReadCustomerPromos(Request $request) {
        return json_encode(Account::find($request->id)->promos);
    }
    public function ReadCustomersByPromo(Request $request) {
        return json_encode(Promo::where('code', $request->code)->first()->accounts);
    }  
    public function UpsertCustomerPromo(Request $request) {
        
        // Validate code input.
        $result =
            Validator::make($request->all(), [
                'code'      => 'required|max:100'
            ]);

        if($result->fails()) 
            return json_encode([
                'code'      => 0,
                'message'   => 'Promo code is required.'
            ]);

        // Check if code exists.
        $promo = Promo::where('code', $request->code)->first();
        if($promo == null)         
            return json_encode([
                'code'      => 0,
                'message'   => 'Code does not exist.'
            ]);

        // Check if customer is already using the code.
        if($promo != null) {
            $account_promo = AccountPromo::where('account_id', $request->account_id)->where('promo_id', $promo->id)->first();
            if($account_promo != null)          
                return json_encode([
                    'code'      => 0,
                    'message'   => 'Code already used.'
                ]);
            else {
                $account_promo              = new AccountPromo;
                $account_promo->account_id  = $request->account_id;
                $account_promo->promo_id    = $promo->id;
                $account_promo->save();
                return json_encode([
                    'code'      => 1,
                    'message'   => 'Code successfully added.'
                ]);
            }
        }

    }
    public function DeleteCustomerPromo(Request $request) {
        $data = AccountPromo::find($request->id);
        if($data<>null) $data->delete();
    }
    
    // LOGS
    public function LogAccount($datatable) {
        $account    = Account::find(Session::get('app_account_id'));
        $log        = Log::where('account_id', $account->id)->where('datatable', $datatable)->first();
        if($log == null) $log = new Log;
        $log->datatable     = $datatable;
        $log->account_id    = $account->id;
        $log->notes         = $account->name.' accessed '.$datatable.' - '.date(DATE_RFC2822);
        $log->save();
    }
    public function LogCustomer($datatable) {
        $account    = Account::find(Session::get('app_customer_id'));
        $log        = Log::where('account_id', $account->id)->where('datatable', $datatable)->first();        
        if($log == null) $log = new Log;
        $log->datatable     = $datatable;
        $log->account_id    = $account->id;
        $log->notes         = $account->firstname.' '.$account->lastname.' accessed '.$datatable.' - '.date(DATE_RFC2822);
        $log->save();
    }
    public function LogPhotographer($datatable) {
        $account    = Account::find(Session::get('app_photographer_id'));
        $log        = Log::where('account_id', $account->id)->where('datatable', $datatable)->first();        
        if($log == null) $log = new Log;
        $log->datatable     = $datatable;
        $log->account_id    = $account->id;
        $log->notes         = $account->name.' accessed '.$datatable.' - '.date(DATE_RFC2822);
        $log->save();
    }
    public function LogDesigner($datatable) {
        $account    = Account::find(Session::get('app_designer_id'));
        $log        = Log::where('account_id', $account->id)->where('datatable', $datatable)->first();        
        if($log == null) $log = new Log;
        $log->datatable     = $datatable;
        $log->account_id    = $account->id;
        $log->notes         = $account->name.' accessed '.$datatable.' - '.date(DATE_RFC2822);
        $log->save();
    }

    // MAIL
    public function PingEmail(Request $request) {

    $data = [
        'name'  => 'PING EMAIL',
        'email' => $request->email,
        'view'  => 'common.email.notify_old_customer'
    ];

    // Send the email
    Mail::send(new Notification($data));
        return json_encode("Success.");
    }

    // MENUS
    public function ReadMenusByRole(Request $request) {
        return json_encode(MenuRole::where('role_id', $request->role_id)->with('menu')->with('role')->orderBy('menu_id')->get());
    }

    // NOTIFICATIONS
    public function ReadAccountNotifications(Request $request) {
        $logs   = Log::where('account_id', $request->id)->first();
        $shoots = Quotation::where('created_at', '>', $logs->updated_at)->get()->count();
        return json_encode([
            'shoots' => $shoots
        ]);
    }
    public function ReadPhotographerNotifications(Request $request) {
        // $logs   = Log::where('account_id', $request->id)->first();
                
        // $quotes = AccountZipcode::where('account_id', $request->id)
        //                              ->with(['shoots' => function($shoot) {
        //                                         $shoot->where('account_id', null);
        //                                     }])
        //                              ->get();
        
        // $shoots = collect();
        
        // if($quotes != null)
        //     foreach ($quotes as $i => $i_v)
        //         if($i_v->shoots != null)
        //             foreach($i_v->shoots as $j => $j_v)
        //                 if($j_v->created_at > $logs->updated_at) $shoots->push($j_v);
        
        // // $shoots = Quotation::where('created_at', '>', $logs->updated_at)->get()->count();
        // return json_encode([
        //     'shoots' => count($shoots)
        // ]);
        return json_encode([
            'shoots' => 0
        ]);
    }
    
    // PHOTOGRAPHERS
    public function ReadPhotographers() {
        return json_encode(Role::find(5)->accounts);
    }

    // PHOTOGRAPHER - ZIPCODES
    public function ReadPhotographerZipcodes(Request $request) {
        try {
            return json_encode(Account::find($request->id)->zipcodes);
        } catch (\Throwable $th) {
            return json_encode([]);
        }
    }
    public function UpsertPhotographerZipcode(Request $request) {

        $account    = Account::find($request->id);
        $zipcode    = $account->zipcodes->where('zipcode', $request->zipcode)->first();
        
        if($request->zipcode_id > 0 && $zipcode!=null) {
            if($zipcode->id == $request->zipcode_id) { // Check if account only wants to update the on site fee.
                $zipcode->fee = $request->fee;
                $zipcode->save();
                return json_encode([]);
            }
        }
        
        if($zipcode!=null) {
            return json_encode([
                'result_code'   => 0,
                'message'       => $zipcode->zipcode.' is already assigned to '.$account->name.'.'
            ]);
        }
        else {
                                
            $z_data = Zipcode::where('zipcode', $request->zipcode)->first();
            if($z_data==null) $z_data = new Zipcode;
            $z_data->zipcode    = $request->zipcode;
            $z_data->fee        = $request->fee;
            $z_data->save();

            $pz_data = AccountZipcode::where('account_id', $request->id)
                                            ->where('zipcode_id', $z_data->id)
                                            ->first();

            if($pz_data==null) $pz_data = new AccountZipcode;
            $pz_data->zipcode_id    = $z_data->id;
            $pz_data->account_id    = $request->id;
            $pz_data->save();

        }
        
        return json_encode(Account::find($request->id)->zipcodes);

    }
    public function DeletePhotographerZipcode(Request $request) {
        $data = AccountZipcode::where('account_id', $request->pivot['account_id'])
                                    ->where('zipcode_id', $request->pivot['zipcode_id'])
                                    ->first()
                                    ->delete();
        return json_encode(Account::find($request->pivot['account_id'])->zipcodes);
    }
    
    // PRICING
    public function ReadPricings() {
        return json_encode(Pricing::all());
    }
    public function ReadPricing(Request $request) {

        // This is where pricing is based on ZIPCODE
        return json_encode(
            Pricing::where('zipcode_id', Quotation::find($request->id)->zipcode_id)->get()
                //    ->orWhere('zipcode_id', Zipcode::where('zipcode', 'default')->first()->id)->get()
        );

    }
    public function ReadPricingByZipcode(Request $request) {
        return json_encode(
            Pricing::where('zipcode_id', $request->id)->with('service')->with('unit')->with('zipcode')->get()
        );
    }
    public function ReadPricingByService(Request $request) {
        return json_encode(
            Service::find($request->id)->pricings
        );
    }
    public function UpsertPricing(Request $request) {
        
        $data = Pricing::find($request->id);

        if($data==null) $data = new Pricing;

        // Check if service exists. If not, add new.
        $service = Service::where('title', $request->service)->first();
        if($service==null) $service = new Service;
        $service->title = $request->service;
        $service->save();

        // Check if unit exists. If not, add new.
        $unit = Unit::where('name', $request->unit)->first();
        if($unit==null) $unit = new Unit;
        $unit->name = $request->unit;
        $unit->save();

        // Check if zipcode exists. If not, add new.
        $zipcode = Zipcode::where('zipcode', $request->zipcode)->first();
        if($zipcode==null) $zipcode = new Zipcode;
        $zipcode->zipcode = $request->zipcode;
        $zipcode->save();

        $data->unit_id      = $unit->id;
        $data->zipcode_id   = $zipcode->id;
        $data->service_id   = $service->id;
        $data->price        = $request->price;
        
        $data->save();

    }
    public function DeletePricing(Request $request) {
        $data = Pricing::find($request->id);
        if($data<>null) $data->delete();
    }
    
    // PROMOS
    public function ReadPromos() {
        return json_encode(Promo::all());
    }
    public function UpsertPromo(Request $request) {
        
        $data = Promo::find($request->id);
        if($data==null) $data = new Promo;
        $data->name         = $request->name;
        $data->code         = $request->code;
        $data->daysvalid    = $request->daysvalid;
        $data->discount     = $request->discount;
        $data->notes        = $request->notes;
        $data->save();

    }
    public function DeletePromo(Request $request) {
        $data = Promo::find($request->id);
        if($data<>null) $data->delete();
    }
    
    // QUOTATIONS / SHOOTS
    public function ReadQuotations() {
        return json_encode(array_values(
                Quotation::with('zipcode')
                         ->with('status')
                         ->with('customer')
                         ->with('accounts')
                         ->get()->SortByDesc('id')->toArray()));
        return json_encode(array_values(Quotation::with('zipcode')->with('status')->with('accounts')->get()->SortByDesc('id')->toArray()));
    }
    public function ReadQuotation(Request $request) {
        return json_encode(Quotation::with('zipcode')->with('status')->with('customer')->where('id', $request->id)->first());
    }
    public function ReadQuotedCustomer(Request $request) {
        return json_encode(Quotation::find($request->id)->customer);
    }
    public function ReadCustomerQuotations(Request $request) {
        return json_encode(
            Quotation::with('zipcode')->with('status')->with('customer')->with('handler')->whereIn('id', Account::find($request->id)->customerQuotations->pluck('id'))->get()
            // array_values(Account::find($request->id)->customerQuotations->SortByDesc('id')->toArray())
            // Customer::find($request->id)->quotations
        );
    }
    public function ReadAvailableQuotations(Request $request) {
        return json_encode(
                    array_values(
                        Quotation::with('zipcode')->with('status')->where('current_status', 1)->whereIn('zipcode_id', Account::find($request->id)->zipcodes->pluck('id'))->get()
                    ->SortByDesc('id')->toArray()));
    }
    public function ReadPhotographerQuotations(Request $request) {
        return json_encode(
            Quotation::with('zipcode')->with('status')->with('customer')->whereIn('id', Account::find($request->id)->quotations->pluck('id'))->get()
            // array_values(Quotation::with('zipcode')->with('status')->with('customer')->where('photographer_id', $request->id)->get()->SortByDesc('id')->toArray())
        );
    }
    public function ReadQuotationContributors(Request $request) {
        return json_encode(
            Account::with('roles')->whereIn('id', Quotation::find($request->id)->accounts->pluck('id'))->get()
        );
    }
    public function AssignQuotation(Request $request) {

        $data = Quotation::find($request->id);

        if($data->current_status == 1) {

            $data->assigned_to      = $request->account_id;
            $data->previous_status  = $data->current_status;
            $data->current_status   = $data->current_status + 1;
            $data->save();
    
            $aq = AccountQuotation::where('quotation_id', $data->id)->where('account_id', $request->account_id)->first();
            if($aq == null) $aq = new AccountQuotation;
            $aq->account_id     = $request->account_id;
            $aq->quotation_id   = $data->id;
            $aq->save();

        }

        return json_encode('Success.');

    }
    public function UpsertQuotation(Request $request) {
           
        try {
            $data = Quotation::find($request->id);

            if($data==null) $data = new Quotation;

            $data->title        = $request->title;
            $data->address      = $request->address;
            $data->start_date   = $request->start_date;
            // $data->end_date     = $request->end_date;
            
            // Check if zipcode exists. If not, add new.
            $zipcode = Zipcode::where('zipcode', $request->zipcode)->first();
            if($zipcode==null) {
                $zipcode = new Zipcode;
                $zipcode->zipcode = $request->zipcode;
                $zipcode->save();
            }

            $data->customer_id      = $request->customer_id;
            $data->zipcode_id       = $zipcode->id;
            $data->notes            = $request->notes;
            $data->current_status   = $request->status_id;
            $data->completed        = 0;
            $data->save();

            return json_encode("success.");

        } catch (\Throwable $th) {
            return json_encode($th);
        }
        

    }
    public function UpdateQuotationStatusById(Request $request) {
       
        $data               = Quotation::find($request->id);
        $data->status_id    = $request->status_id;
        $data->save();

        return json_encode(
            Account::find($data->customer_id)->quotations
        );

    }
    public function UpdateQuotationStatusByFlow(Request $request) {
        
        $data                   = Quotation::find($request->id);
        $data->previous_status  = $data->current_status;
        $data->current_status   = $data->current_status + 1;
        $data->save();

        return json_encode(
            Account::find($data->customer_id)->quotations
        );

    }
    public function DeleteQuotation(Request $request) {
        $data = Quotation::find($request->id);
        $data->delete();
        $this->DeleteBreakdowns($request->id);
    }

    // ROLES
    public function ReadRoles() {
        return json_encode(Role::all());
    }
    public function UpsertRole(Request $request) {
        $data = Role::find($request->id);
        if($data == null) $data = new Role;
        $data->name         = $request->name;
        $data->display_name = $request->display_name;
        $data->save();
    }
    public function DeleteRole(Request $request) {
        $data = Role::find($request->id);
        if($data <> null) $data->delete();
    }

    // SERVICES
    public function ReadServices() {
        return json_encode(Service::with('type')->get());
    }
    public function ReadServiceById(Request $request) {
        return json_encode(
            Service::find($request->id)
        );
    }
    public function SaveService(Request $request) {

        $service = Service::find($request->id);

        if(!$service==null) {

            $service->title = $request['title'];
            $service->description_01 = $request['description_01'];
            $service->description_02 = $request['description_02'];

            if($request->file('hover_icon')) {
                if(!$service->hover_icon == null) $this->DeleteFile($service->hover_icon);
                $service->hover_icon = ($this->UploadFile($request->file('hover_icon')))[0];
            }
            if($request->file('thumbnail')){
                if(!$service->thumbnail == null) $this->DeleteFile($service->thumbnail);
                $service->thumbnail = ($this->UploadFile($request->file('thumbnail')))[0];
            } 
            if($request->file('photos')){
                $service->photos = json_encode($this->UploadFile($request->file('photos')));
            }
            
            $service->save();
            
        }
        else {
            
            $service = new Service;
            $service->title = $request['title'];
            $service->description_01 = $request['description_01'];
            $service->description_02 = $request['description_02'];
            
            if($request->file('hover_icon'))    $service->hover_icon    = ($this->UploadFile($request->file('hover_icon')))[0];
            if($request->file('thumbnail'))     $service->thumbnail     = ($this->UploadFile($request->file('thumbnail')))[0];
            if($request->file('photos'))        $service->photos        = json_encode($this->UploadFile($request->file('photos')));
            else                                $service->photos        = json_encode([]);

            $service->save();

        }

        return back();

    }
    public function DeleteService(Request $request) {
        $data = Service::find($request->id);
        if($data <> null) $data->delete();
    }

    // SERVICE TYPE
    public function ReadServiceTypes() {
        return json_encode(Service::with('type')->get());
    }
    public function UpsertServiceType(Request $request) {
        
        $data = Service::find($request->id);
        $type = Type::where('display_name', $request->type)->first();

        if($type == null) $type = new Type;
        $type->display_name = $request->type;

        $data->type_id  = $type->id;
        $data->save();
        
    }
    public function DeleteServiceType(Request $request) {
        // $data = Service::find($request->id);
        // if($data != null) $data->delete();
    }

    // SHOOTS
    public function ReadShootsByAccountWithZip(Request $request) {
        return json_encode(
            array_values(
                Quotation::with('zipcode')->with('status')->where('current_status', 1)->whereIn('zipcode_id', Account::find($request->id)->zipcodes->pluck('id'))->get()
            ->SortByDesc('id')->toArray()));
    }
    public function ReadShootsByAccount(Request $request) {
        return json_encode(
            Quotation::with('status')->with('handler')->whereIn('id', Account::find($request->id)->quotations->pluck('id'))->get()
        );
    }
    public function ReadShootsByCustomer(Request $request) {
        return json_encode(
            Quotation::with('status')->with('handler')->whereIn('id', Account::find($request->id)->customerQuotations->pluck('id'))->get()
        );
    }
    public function ReadShootsByStatusAndCompletion(Request $request) {
        return json_encode(
            array_values(
                Quotation::with('status')->with('handler')->where('current_status', $request->status_id)->where('completed', $request->completed)->get()
            ->SortByDesc('id')->toArray()));
    }
    public function UpdateShootStatusAndHandler(Request $request) {
        $data = Quotation::find($request->id);
        $data->assigned_to    = $request->account_id;
        $data->current_status = $data->current_status + 1;
        $data->save();
        // return $this->ThrowResponse('Success.');
    }
    public function MarkAsMyShoot(Request $request) {
        
        $data = AccountQuotation::where('quotation_id', $request->quotation_id)->where('account_id', $request->account_id)->first();
        
        if($data!=null) $data->delete();
        
        $data = new AccountQuotation;
        $data->quotation_id = $request->quotation_id;
        $data->account_id   = $request->account_id;   
        $data->completed    = 0;
        $data->save();

        $data = Quotation::find($request->quotation_id);
        $data->assigned_to      = $request->account_id;
        $data->current_status   = $data->current_status + 1;
        $data->completed        = 0;
        $data->save();

        return $this->ThrowResponse(1, 'Success.');

    }
    public function MarkShootAsCompleteByHandler(Request $request) {

        $data = Quotation::find($request->id);
        $data->completed = 1;
        $data->save();

        $data = AccountQuotation::where('quotation_id', $request->id)->where('account_id', $data->assigned_to)->first();
        $data->completed = 1;
        $data->save();

        return $this->ThrowResponse(1, 'Success.');

    }
    public function MarkShootAsReady(Request $request) {

        $data = Quotation::find($request->id);
        $data->completed        = 0;
        $data->current_status   = 5;
        $data->save();

        $data = AccountQuotation::where('quotation_id', $request->id)->where('account_id', $data->assigned_to)->first();
        $data->completed = 1;
        $data->save();

        return $this->ThrowResponse(1, 'Success.');

    }
    
    // STATUS
    public function ReadStatus() {
        return json_encode(Status::all());
    }
    public function UpsertStatus(Request $request) {
        
        $data = Status::find($request->id);
        if($data==null) $data = new Status;
        $data->client_status    = $request->client_status;
        $data->work_status      = $request->work_status;
        $data->flow             = $request->flow;
        $data->save();

        return $this->ThrowResponse(1, 'Success.');

    }
    public function DeleteStatus(Request $request) {
        $data = Status::find($request->id);
        $data->delete();
    }
    
    // TYPES
    public function ReadTypes() {
        return json_encode(Type::all());
    }
    public function UpsertType(Request $request) {
        // 
    }
    public function DeleteType(Request $request) {
        $data = Type::find($request->id);
        if($data != null) $data->delete();
    }

    // UNITS
    public function ReadUnits() {
        return json_encode(Unit::all());
    }
    public function UpsertUnit(Request $request) {
        
        $data = Unit::find($request->id);

        if($data==null) $data = new Unit;

        $data->name = $request->name;
        $data->save();

    }
    public function DeleteUnit(Request $request) {
        $data = Unit::find($request->id);
        $data->delete();
    }

    // UPLOADS
    public function ReadUploadsByBreakdown(Request $request) {
        return json_encode(Breakdown::with('uploads')->where('id', $request->id)->get());
    }
    public function ReadUploadsByQuotation(Request $request) {
        return json_encode(Quotation::with('uploads')->where('id', $request->id)->first());
    }
    public function UploadContent(Request $request) {
        $data               = new Upload;
        $data->owner        = $request->owner;
        $data->owner_id     = $request->owner_id;
        $data->uploaded_by  = $request->uploaded_by;
        
        if($request->file('file')){
            $data->value    = $this->UploadFile($request->file('file'))[0];
            $data->element  = $request->element;
        }

        $data->save();
    }
    public function UpsertUploadedContent(Request $request) {
        $data = Upload::where('owner_id', $request->owner_id)
                      ->where('owner', $request->owner)
                      ->where('uploaded_by', $request->uploaded_by)
                      ->where('element', $request->element)
                      ->first();
        if($data == null) $data = new Upload;
        $data->owner        = $request->owner;
        $data->owner_id     = $request->owner_id;
        $data->uploaded_by  = $request->uploaded_by;
        $data->value        = json_encode($request->value);
        $data->element      = $request->element;
        $data->save();
        return json_encode("Success.");
    }
    public function DeleteUploadedContent(Request $request) {
        $data = Upload::find($request->id);
        if($data!=null) {
            if($data->element=='image' || $data->element=='video') $this->DeleteFile($data->value);
            $data->delete();
        }
    }
    
    // ZIPCODES
    public function ReadZipcodes() {
        return json_encode(Zipcode::all());
    }
    public function UpsertZipcode(Request $request) {
        
        $data = Zipcode::find($request->id);

        if($data==null) $data = new Zipcode;

        $data->zipcode  = $request->zipcode;
        $data->fee      = $request->fee;
        $data->save();

    }
    public function DeleteZipcode(Request $request) {
        $data = Zipcode::find($request->id);
        $data->delete();
    }
    
    
}
