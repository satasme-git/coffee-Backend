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

class RegisterController extends Controller
{
    
	
	
	/**
	* Registers a new user
	*
	* @param Request $request
	* @return array $data
	*/
	public function register(Request $req){
			
		
		
		/* Taking all data from POST */
		$userData = array(
		  'name'    =>  $req->get('cus_name'),
		  'email'   =>  $req->get('cus_email'),
		  'mobile_no'  	=>  $req->get('cus_mobile_number'),
		  'password' 	=> 	$req->get('cus_password')
		);
		
			$userData['password'] = Hash::make($userData['password']);												
			$userData['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
			$userdata['status']='0';
			
			/* Inserting into the user table */
			$id = DB::table('users')->insertGetId($userData); 
			$usersendData = array(
				'userid'  	=>   $id,
				'name' 	=>   $req->get('cus_name'),
				'email'   =>  $req->get('cus_email')
			  );
		return json_encode($usersendData);
	}

	protected function checkUser($data){
		$user= DB::table('users')
                     ->where('email', '=', $data['email'])
                     ->get()->first();
		if(!empty($user) && Hash::check($data['password'], $user->password)){
			return $user;
		}else{
			return false;
		}			 
					 
	}

	public function login(Request $req ){
		
		$userData = array(
		  'email'  	=>   $req->get('user_email'),
		  'password' 	=>   $req->get('user_password'),
		);
		
		/* Taking all data from POST */
		
			if($user = $this->checkUser($userData)){
				/* comparing entered password with database */
				/*check user status*/
				if($user->status == 0){
					return response()->json(['status' => true,'id'=>$user->id,'name'=>$user->name,'email'=>$user->email]);
				}else{
					return response()->json(['status' => false,'msg'=>'Your account has been blocked by admin. Please contact the administrator.']);
				}
			}else{
				return response()->json(['status' => false,'msg'=>'Invalid username or password.']);
			}
		
	}

	protected function profile($id){
		$user= DB::table('users')
				->join('order_points', 'order_points.users_id', '=','users.id')
				->select(DB::raw('sum(order_points.points) as points'))
				->addSelect('users.*')
				->where('users.id', '=', $id)
				->groupBy('users.id')
                ->get()->first();
		
		return response()->json($user);
					 
	}
	
}