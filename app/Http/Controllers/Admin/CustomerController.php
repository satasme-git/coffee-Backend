<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use File;
use Session;
use Redirect;
use App\Models\Users;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;



class CustomerController extends Controller
{
    public function __construct()
    {
        // if(empty(Session::get('user_email'))){
 
        //     Redirect::to('/')->send();
        //   }
        //   $this->middleware(function ($request, $next) {
        //     if (Session::get("user_email") == "") {
        //         Redirect::to('/')->send();
        //     }
        //     return $next($request);
        // });
    }
    protected function Customers()
    {
        // $data['records'] = DB::table('users')->get()->all();
        	     $data['records']= DB::table('users')
				->leftjoin('order_points', 'order_points.users_id', '=','users.id')
				// ->selectRaw(DB::raw('sum(order_points.points) as points'))
				
				->addSelect(DB::raw('sum(order_points.points) as points'))
				->addSelect('users.*')
				->groupBy('users.id')
				->orderBy('users.id', 'DESC')
                ->get();
	    return view('admin/users',$data);
	    
	    

	}
	
	protected function addCustomers($id = 0, Request $req )
    {
		$data=[];
		if(!empty($id)){
			$data['records'] = DB::table('users')->where('id',$id)->get()->first();
			
			if(empty($data['records'])){
				return redirect('/admin/users');
            }
             $points = DB::table('users')
                            ->join('order_points', 'order_points.users_id', '=', 'users.id')
                            ->select(DB::raw('sum(order_points.points) as points'))
                            ->addSelect('users.*')
                            // ->where('users.id', '=', $id)
                            ->where([
                                    ['users.id', '=', $id],
                                    ['order_points.status', '=', 'Active']
                            ])
                            ->groupBy('users.id')
                            ->get()->first();


            $data['points'] = $points;
		}
		return view('admin/addUsers',$data);
	   
    }

	protected function saveCustomers(Request $req )
    {
		$name =$req->get('name');
        $email =$req->get('email');
        $mobile_no =$req->get('mobile_no');
		$status =1;
		
		$id =$req->get('id');
        // $user = $req->file('user');

		$validationdata = array('name'=>$name,'email'=>$email,'mobile_no'=>$mobile_no);
		$validationtype = array('email' => 'required','mobile_no' => 'required','name' => 'required');
		
		$validator  = Validator::make($validationdata, $validationtype);;
		
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput();
		}else{
			$data = [
			         
			         'name' => $name,
			         'email' => $email,
			         'mobile_no' => $mobile_no,
			          'status' => $status,
					 ];
				// 	 if($status == 'Active'){
				// 		$data['status']='0';
				// 	 }else{
				// 		$data['status']='1';
				// 	 }
					 
			// if ($req->hasFile('user')) {
			// 	$image = $req->file('user');
			// 	$imagename = $time.'cfimg.'.$image->getClientOriginalExtension();
			// 	$destinationPath = public_path('/images/user/');
				
			// 	if(!File::isDirectory($destinationPath)){
			// 		File::makeDirectory($destinationPath, 0777, true, true);
			// 	}
				
			// 	$filename    = $image->getClientOriginalName();
			// 	$image_resize = \Image::make($image->getRealPath())->save($destinationPath.$imagename);
			// 	$data['img']=$imagename;
				
				
			// }
			if(!empty($id)){
				DB::table('users')->where('id', $id)->update($data);
				$req->session()->flash('msg', '<div class="alert alert-success">Record updated <a class="close" data-dismiss="alert">×</a> </div>');
			}else{
			    $id = DB::table('users')->insertGetId($data);
				 
				$req->session()->flash('msg', '<div class="alert alert-success">Record Added <a class="close" data-dismiss="alert">×</a> </div>');
			}
			
			return redirect('admin/customers');
		}
    }
	protected function deleteCustomers($id,Request $req )
    {
		$data = ['status' => '1',];
		DB::table('users')->where('id', $id)->update($data);
		$req->session()->flash('msg', '<div class="alert alert-success">Customer blacklisted <a class="close" data-dismiss="alert">×</a> </div>');
	   return redirect('admin/customers');
	}
	    public function blacklist($id)
    {
        $msg=3;
        $customers = Users::find($id);
        $customers->status = 1;
        $customers->save();
 
        return redirect('admin/customers');
//        return view('Customer.ViewCustomer', compact('customers','msg'));
    }
    public function active($id)
    {
        $msg=4;
        $customers = Users::find($id);
        $customers->status = 0;
        $customers->save();
   
         return redirect('admin/customers');
//        return view('Customer.ViewCustomer', compact('customers','msg'));
    }
    
     public function create() {

        return view('admin/AddCustomes');
    }

    public function add_customer(Request $req) {

        $name = $req->get('name');
        $email = $req->get('email');
        $mobile_no = $req->get('mobile_no');



        $validationdata = array('name' => $name, 'email' => $email, 'mobile_no' => $mobile_no);
        $validationtype = array('email' => 'required', 'mobile_no' => 'required', 'name' => 'required');

        $validator = Validator::make($validationdata, $validationtype);
        

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
              $user = Users::where( 'email', '=', $email )->first();
              if (empty( $user ) ) {
                    $data = [
                        'name' => $name,
                        'email' => $email,
                        'mobile_no' => $mobile_no,
                        'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                        'password' => Hash::make(123),
                        'status' => 0,
                        // 'image' => $imagename,
                    ];
                    $time = time();
                    if ($req->hasFile('food')) {
        
                        $image = $req->file('food');
                        $imagename = $time . 'cfimg.' . $image->getClientOriginalExtension();
                        $destinationPath = public_path('/images/Customer/');
        
        
                        if (!File::isDirectory($destinationPath)) {
                            File::makeDirectory($destinationPath, 0777, true, true);
                        }
        
                        $filename = $image->getClientOriginalName();
                        $image_resize = \Image::make($image->getRealPath())->save($destinationPath . $imagename);
                        $data['image'] = $imagename;
                    }
                   
                    $id = DB::table('users')->insertGetId($data);
                    $req->session()->flash('msg', '<div class="alert alert-success">Record Added <a class="close" data-dismiss="alert">×</a> </div>');
                    return redirect('/admin/createCustomer');
            }else{
                $req->session()->flash('msg', '<div class="alert alert-danger">Email already exists <a class="close" data-dismiss="alert">×</a> </div>');
                    return redirect('/admin/createCustomer'); 
            }
        }
    }

    public function updateCustomerById(Request $req, $id) {

        $name = $req->get('name');
        $email = $req->get('email');
        $mobile_no = $req->get('mobile_no');
        $validationdata = array('name' => $name, 'email' => $email, 'mobile_no' => $mobile_no);
        $validationtype = array('email' => 'required', 'mobile_no' => 'required', 'name' => 'required');

        $validator = Validator::make($validationdata, $validationtype);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if ($req->get('ad_point') != 0) {

                $data = [
                    'orders_id' => 0,
                    'users_id' => $id,
                    'point_id' => 1,
                    'points' => $req->get('ad_point'),
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'status' => "Active",
                ];
                DB::table('order_points')->insertGetId($data);
            }

            $data2 = [
                'name' => $name,
                'email' => $email,
                'mobile_no' => $mobile_no,
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ];

            DB::table('users')->where('id', $id)->update($data2);
        }
        $req->session()->flash('msg', '<div class="alert alert-success">Record Updated <a class="close" data-dismiss="alert">×</a> </div>');
        return redirect('admin/customers');
    }
    

    
}
