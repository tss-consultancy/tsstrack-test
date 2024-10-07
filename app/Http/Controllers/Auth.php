<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Redirect;

class Auth extends Controller
{
    public function index(){
        return view('auth.login');
    }
   public function authentication(Request $request){
    $request->validate([
        'useremail'=>'required|email',
        'userpassword'=>'required'
    ]);
    $users = Users::all();
    $email = $request['useremail'];
    $password = $request['userpassword'];
    $data = compact('users');
 
    foreach ($data['users'] as $key ) {
    
        if ($key->user_email == $email) {
        
        $passwordIsOk = password_verify( $password, $key->user_password );
            if ($passwordIsOk == true) {
                session(['login'=>'success']);
                // session(['showalert'=>true]);
                return Redirect::to('/dashboard')->with('success','Login Successfull!');
            }else{
  
                // return view('auth.login');
                return Redirect::to('/')->with('error','Login failed due to incorrect password !');
            }
            
        }
    }
    
   
    return Redirect::to('/')->with('error','Email does not exist!');
    

    

   }
   public function logout(){
    session()->forget('login');
    return Redirect::to('/');
   }
   
}
