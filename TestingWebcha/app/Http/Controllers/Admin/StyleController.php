<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use File;


class StyleController extends Controller
{
    

	protected function slides()
    {
		
		$records = DB::table('slides')->get()->all();
        return view('admin/slides', ['records' => $records]);
	   
	}

	protected function addslides($id)
    {
		$data=[];
		if(!empty($id)){
			$data['slides'] = DB::table('slides')->where('id',$id)->get()->first();
			
			if(empty($data['slides'])){
				return redirect('/admin/slides');
			}
		}
		return view('admin/addslides',$data);
	   
	}
	
	protected function saveslides(Request $req )
    {
		$id =$req->get('id');
		$description =$req->get('description');
		$image = $req->file('thumb');
		$time=time();
		$imagename = $time.'_thumb.'.$image->getClientOriginalExtension();
		$destinationPath = public_path('/work/public/images/slides/');
		$destinationPath2 = public_path('/');
		
		if(!File::isDirectory($destinationPath)){
			File::makeDirectory($destinationPath, 0777, true, true);
		}
		
		$filename    = $image->getClientOriginalName();
		$image_resize = \Image::make($image->getRealPath())->save($destinationPath.$imagename);
		$image_resize2 = \Image::make($image->getRealPath())->save($destinationPath2.$imagename);
		$data['thumb']=$imagename;
		$data['description']=$description;
		
		if(!empty($id)){
			DB::table('slides')->where('id', $id)->update($data);
			$req->session()->flash('msg', '<div class="alert alert-success">Record updated <a class="close" data-dismiss="alert">×</a> </div>');
		}else{
			//DB::table('product')->insert($data);
			$id = DB::table('slides')->insertGetId($data);
			 
			$req->session()->flash('msg', '<div class="alert alert-success">Record Added <a class="close" data-dismiss="alert">×</a> </div>');
		}
		
		return redirect('admin/slides');
	}

	protected function deleteslides($id=0,Request $req )
    {
		
		if(!empty($id)){
		    DB::table('slides')->where('id', $id)->delete();
			return redirect()->to('/admin/slides')->with('msg', '<div class="alert alert-success">Record deleted.<a class="close" data-dismiss="alert">×</a></div>.');
		}else{
			return redirect()->to('/admin/slides')->with('msg', '<div class="alert alert-success">Invalid record.<a class="close" data-dismiss="alert">×</a></div>');
		}
	   
	}

	protected function getslides()
    {
		
		$records = DB::table('slides')->get()->all();
        return json_encode($records);
	   
	}
	
}
