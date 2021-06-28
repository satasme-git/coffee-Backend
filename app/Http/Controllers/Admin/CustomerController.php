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

class CustomerController extends Controller {

    public function __construct() {
        // if(empty(Session::get('user_email'))){
        //     Redirect::to('/')->send();
        //   }
    }

    protected function Customers() {
        $data['records'] = DB::table('users')->get()->all();
        return view('admin/users', $data);
    }

    protected function addCustomers($id = 0, Request $req) {
        $data = [];
        if (!empty($id)) {
            $data['records'] = DB::table('users')->where('id', $id)->get()->first();

            if (empty($data['records'])) {
                return redirect('/admin/users');
            }
        }
        return view('admin/addUsers', $data);
    }

    protected function saveCustomers(Request $req) {
        $name = $req->get('name');
        $email = $req->get('email');
        $mobile_no = $req->get('mobile_no');
        $status = 1;

        $id = $req->get('id');
        // $user = $req->file('user');

        $validationdata = array('name' => $name, 'email' => $email, 'mobile_no' => $mobile_no);
        $validationtype = array('email' => 'required', 'mobile_no' => 'required', 'name' => 'required');

        $validator = Validator::make($validationdata, $validationtype);
        ;

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
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
            if (!empty($id)) {
                DB::table('users')->where('id', $id)->update($data);
                $req->session()->flash('msg', '<div class="alert alert-success">Record updated <a class="close" data-dismiss="alert">×</a> </div>');
            } else {
                $id = DB::table('users')->insertGetId($data);

                $req->session()->flash('msg', '<div class="alert alert-success">Record Added <a class="close" data-dismiss="alert">×</a> </div>');
            }

            return redirect('admin/customers');
        }
    }

    protected function deleteCustomers($id, Request $req) {
        $data = ['status' => '1',];
        DB::table('users')->where('id', $id)->update($data);
        $req->session()->flash('msg', '<div class="alert alert-success">Customer blacklisted <a class="close" data-dismiss="alert">×</a> </div>');
        return redirect('admin/customers');
    }
    public function blacklist($id)
    {
        $msg=3;
        $customers = Users::find($id);
        $customers->status = 0;
        $customers->save();
 
        return redirect('admin/customers');
//        return view('Customer.ViewCustomer', compact('customers','msg'));
    }
    public function active($id)
    {
        $msg=4;
        $customers = Users::find($id);
        $customers->status = 1;
        $customers->save();
   
         return redirect('admin/customers');
//        return view('Customer.ViewCustomer', compact('customers','msg'));
    }

}
