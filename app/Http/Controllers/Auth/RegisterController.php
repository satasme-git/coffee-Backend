<?php

namespace App\Http\Controllers\Auth;
//use App\Http\Controllers\Auth\Input ;
use App\User;
use App\Models\System_user;
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




use Intervention\Image\ImageManagerStatic as Image;
use File;

use Redirect;

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
			$userData['status']='0';
			
			/* Inserting into the user table */
			if ($this->checkAlreadySigned($userData['email'])==false){
			    
			   $id = DB::table('users')->insertGetId($userData); 
        			$usersendData = array(
        				'userid'  	=>   $id,
        				'name' 	=>   $req->get('cus_name'),
        				'email'   =>  $req->get('cus_email'),
        				'mobile_no'   =>  $req->get('cus_mobile_number')
        			  );
        		return json_encode($usersendData); 
    
        // 		return json_encode('Done');
			}
			else{
			    return json_encode('Already');
			}
			
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
	
	protected function checkAlreadySigned($data){
		$user= DB::table('users')
                     ->where('email', '=', $data)
                     ->get()->first();
		if(!empty($user)){
			return true;
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
					return response()->json(['status' => true,'id'=>$user->id,'name'=>$user->name,'email'=>$user->email,'image'=>$user->image,'mobile_no'=>$user->mobile_no,'msg'=>'Login success.']);
				}
				else{
					return response()->json(['status' => false,'msg'=>'Your account has been blocked by admin. Please contact the administrator.']);
				}
				
				
			}else{
				// return response()->json(['status' => false,'msg'=>'Invalid username or password.']);
				return response()->json(['validation' =>$userData,'status' => false,'msg'=>'Invalid username or password.']);
				
			}
		
	}

	protected function profile($id){
		$user= DB::table('users')
				->select('users.*')
				->where('users.id', '=', $id)
                ->get()->first();
		
		return response()->json($user);
					 
	}
	protected function points($id){
		$user= DB::table('users')
				->join('order_points', 'order_points.users_id', '=','users.id')
				->select(DB::raw('sum(order_points.points) as points'))
				->addSelect('users.*')
				// ->where('users.id', '=', $id)
				->where([
                    ['users.id', '=', $id],
                    ['order_points.status', '=', 'Active']
                ])
				->groupBy('users.id')
                ->get()->first();
		
		return response()->json($user);
					 
	}
	
		protected function count_dataorder($id){
		$user= DB::table('users')
				->join('orders', 'orders.users_id', '=','users.id')
				
				->select(DB::raw('COUNT(orders.orderid) as orders_Count'))
				->where('users.id', '=', $id)
				->groupBy('users.id')
                ->get()->first();
		
		return response()->json($user);
					 
	}
	protected function count_dataorderbox($id){
		$user= DB::table('users')
				->join('order_box', 'order_box.users_id', '=','users.id')
				->select(DB::raw('COUNT(order_box.orderid) as orderbox_Count'))
				->where('users.id', '=', $id)
				->groupBy('users.id')
                ->get()->first();
		
		return response()->json($user);
					 
	}
	
	public function systemUserLoginCheck(Request $request)
    {
        if ($request->email != "" && $request->password != "") {
			$user = System_user::where( 'suser_username', '=', $request->email )->first();
            $users = DB::table('system_users')
                ->select('system_users.*')
                ->where([
                    ['suser_username', '=', $request->email],
                    ['status', '=', 1],
                ])
                ->get()->first();

            if (!empty($users) && Hash::check($request->password, $users->suser_password)) {

                Session::put('user_email', $request->email);
				Session::put('user_info', $user);
                Session::put('role_id', $users->role_id);
          
				return redirect('/admin/food');
            } else {

                $request->session()->flash('msg', '<div class="alert alert-danger">Usernam or Password incorrect <a class="close" data-dismiss="alert">×</a> </div>');
                return view('login');
            }

        } else {
            $request->session()->flash('msg', '<div class="alert alert-danger">Usernam or Password incorrect <a class="close" data-dismiss="alert">×</a> </div>');
            return view('login');
        }
    }
	public function systemuserlogout(Request $request){
		$request->session()->forget('user_email');
		return view('login');
	}
	public function fileUpload(Request $req){
	       $id = $req->get('member_id');
	    
	       if ($req->hasFile('image')) {
	                $time = time();
	                $image =  $req->file('image');
                    $imagename = $time . 'cfimg.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/images/Customer/');

                    if (!File::isDirectory($destinationPath)) {
                        File::makeDirectory($destinationPath, 0777, true, true);
                    }

                    $filename = $image->getClientOriginalName();
                    $image_resize = \Image::make($image->getRealPath())->save($destinationPath . $imagename);
                    $data['image'] = $imagename;
                       DB::table('users')->where('id', $id)->update($data);
	       }
	    
            //  $req->session()->flash('msg', '<div class="alert alert-success">Record updated <a class="close" data-dismiss="alert">×</a> </div>');
          $user= DB::table('users')
				->select('users.*')
				->where('id', '=', $id)
                ->get()->first();
		return response()->json($user);
		
//                     echo json_encode([
// 		"Message"=>$id,
// 		"status"=>"ok"
// 	]);

	}
		public function nameUpdate(Request $req){
		    
	   $userData = array(
		  'name' 	=> 	$req->get('cus_name')
		);
		$id = $req->get('cus_id');

	    $usersendData = DB::table('users')
        ->where('id', $id)
        ->update(['name' => $userData['name']]);
        
		        $user= DB::table('users')
				->select('users.*')
				->where('id', '=', $id)
                ->get()->first();
		return response()->json($user);
		}
		
		public function phoneUpdate(Request $req){
		    
	   $userData = array(
		  'mobile_no' 	=> 	$req->get('cus_phone')
		);
		$id = $req->get('cus_id');

	    $usersendData = DB::table('users')
        ->where('id', $id)
        ->update(['mobile_no' => $userData['mobile_no']]);
        
		        $user= DB::table('users')
				->select('users.*')
				->where('id', '=', $id)
                ->get()->first();
		return response()->json($user);
		}
	public function addStepsByUser(Request $request){

        $usersendData = array(

        				'date' 	=>   $request->get('_date'),
        				'step'   =>  $request->get('_step'),
        				'email'   =>  $request->get('_email')
        			  );
        		return json_encode(5); 
    }
	
}