<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use File;
use Intervention\Image\ImageManagerStatic as Image;

class CustomerController extends Controller
{
    protected function Customers()
    {
        $data['records'] = DB::table('users')->get()->all();
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
		}
		return view('admin/addUsers',$data);
	   
    }

	protected function saveCustomers(Request $req )
    {

        
		$name =$req->get('name');
        $email =$req->get('email');
        $mobile_no =$req->get('mobile_no');
		$status =$req->get('status');
		
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
					 ];
					 if($status == 'Active'){
						$data['status']='0';
					 }else{
						$data['status']='1';
					 }
					 
			
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
}
