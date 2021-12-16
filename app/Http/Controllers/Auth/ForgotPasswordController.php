<?php

namespace App\Http\Controllers\Auth;
//use App\Http\Controllers\Auth\Input ;
use App\User;
use Validator;
use Input;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Response;
use Mail;
use View;
use Session;

// use Illuminate\Bus\Queueable;
// use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;
// use Illuminate\Contracts\Queue\ShouldQueue;

// use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;


use Intervention\Image\ImageManagerStatic as Image;
use File;

use Redirect;

class ForgotPasswordController extends Controller
{
    
	
	
	/**
	* Registers a new user
	*
	* @param Request $request
	* @return array $data
	*/	
	
    
	
	protected function checkAlreadySigned($data){
		$user= DB::table('users')
                     ->where('email', '=', $data)
                     ->get()->first();
		if(!empty($user)){
			return json_encode($user);
		}else{
			return json_encode('Error');
		}			 
					 
	}
	
	public function resetPassword(Request $req){
    	$num_str = sprintf("%06d", mt_rand(1, 999999));
    	
		$userData = array(
		  'email'   =>  $req->get('cus_email')
		);
 
      Mail::to($userData['email'])->send(new SendMail($num_str));
      
      	    $usersendData = DB::table('users')
            ->where('email', $userData['email'])
            ->update(['code' => $num_str]);
      
 
      if ($usersendData=='1') {
          return json_encode('success');
      }else{
          return json_encode('error');
         }
    
	  
		return json_encode($usersendData);


		
		
	}
	
		

	
    public function updatePassword(Request $req){
        
        $userData = array(
		  'password' 	=> 	$req->get('cus_password'),
		  'email' 	=> 	$req->get('cus_email')
		);
		
		$userId= DB::table('users')
                     ->where('email', '=', $userData['email'])
                     ->get()->first();
            
	    $userData['password'] = Hash::make($userData['password']);
	  
	    $usersendData = DB::table('users')
            ->where('email', $userData['email'])
            ->update(['password' => $userData['password']]);
            
        $user= DB::table('users')
				->select('users.*')
				->where('email', '=', $userData['email'])
                ->get()->first();
		
		return response()->json($user);
		
        
// 		return json_encode($userData);
		
		
    	}
    	
	protected function checkCode(Request $req){
	     $userData = array(
		  'code' 	=> 	$req->get('code'),
		);
		
		$user= DB::table('users')
                     ->where('code', '=', $userData['code'])
                     ->get()->first();
                     
		if(!empty($user)){
			return json_encode('success');
		}else{
			return json_encode('Error');
		}			 
					 
	}
	
	
}