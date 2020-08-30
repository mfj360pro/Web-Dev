<?php

namespace App\Http\Controllers;

use Session;
use DB;
use File;
use Response;
use Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class WebServiceHelper extends Controller
{

    private $salt = 'mfj360pro';
    
    public function CheckExistingEmail(Request $request, $table='users') {        
        $data =
            json_decode(
                json_encode(
                    DB::select('
                        SELECT * FROM ' . $table . '
                        WHERE email = ?
                    ',
                        [
                            $request['email']
                        ]
                    ), true
                ), true
            );
        if(count($data)>0) return true;
        return false;
    }

    public function CheckPasswordChanged(Request $request, $table='users') {
        $data = 
            json_decode(
                json_encode(
                    DB::select('
                        SELECT * FROM ' . $table . '
                        WHERE email = ?
                    ',
                        [
                            $request['email']
                        ]
                    ), true
                ), true
            );
        if(count($data)>0)
            if(Hash::check($this->AddSalt($request['password']), $users[0]['password']))
                return false;
        return true;
    }

    public function ThrowResponse($status_code, $message) {
        return 
            json_encode(
                array(
                    "status_code"   => $status_code, 
                    "status"        => $status_code ? "text-success" : "text-danger", 
                    "message"       => $message
                )
            );
    }

    public function EncryptPassword($password) {
        return Hash::make($this->AddSalt($password));
    }

    public function AddSalt($password) {
        return $password . $this->salt;
    }

    public function UploadFile($file) {
        $filenames = [];
        if (!is_array($file)) $file = [$file];
        for ($i = 0; $i < count($file); $i++) {
            $file_new = $file[$i];
            $name = $file_new->getClientOriginalName();
            $filename = 'uploads/' . \str_random(64) . '.' . $file_new->extension();
            array_push($filenames, $filename);
            Storage::put($filename, \File::get($file_new));
        }
        return $filenames;
    }
    
    public function DeleteFile($file) {
        Storage::delete($file);
    }
}
