<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use File;
use Intervention\Image\ImageManagerStatic as Image;

class CoffeeController extends Controller
{
    protected function test()
    {
	   return view('admin/test');
	}

    protected function food()
    {
	   $data['food'] = DB::table('foods')
	   ->join('category', 'category.id', '=','foods.category_id' )
	   ->join('subcategory', 'subcategory.id', '=','foods.subcategory_id' )
	   ->select('foods.*', 'category.name as category')
	   ->addSelect('foods.*', 'subcategory.name as subcategory')
	   ->get();
	   
	   return view('admin/food',$data);
	}
	
	protected function addFood($id = 0, Request $req )
    {
		$data=[];
        $data['category'] = DB::table('category')->get()->all();
        $data['subcategory'] = DB::table('subcategory')->get()->all();
		if(!empty($id)){
			$data['food'] = DB::table('foods')->where('id',$id)->get()->first();
			
			if(empty($data['food'])){
				return redirect('/admin/food');
			}
		}
		return view('admin/addFood',$data);
	   
    }

	protected function saveFood(Request $req )
    {
		$price =$req->get('price');
		$name =$req->get('name');
        $category =$req->get('category');
        $subcategory =$req->get('subcategory');
		$description =$req->get('description');
		
		$id =$req->get('id');
        $food = $req->file('food');

		$validationdata = array('price'=>$price,'category'=>$category,'subcategory'=>$subcategory,'name'=>$name);
		$validationtype = array('price' => 'required','category' => 'required','subcategory' => 'required','name' => 'required',);
		
		$validator  = Validator::make($validationdata, $validationtype);;
		
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput();
		}else{
			$data = [
			         
			         'name' => $name,
			         'price' => $price,
			         'description' => $description,
			         'category_id' => $category,
			         'subcategory_id' => $subcategory,
					 ];
			$time=time();
			if ($req->hasFile('food')) {
				$image = $req->file('food');
				$imagename = $time.'cfimg.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/images/food/');
				
				if(!File::isDirectory($destinationPath)){
					File::makeDirectory($destinationPath, 0777, true, true);
				}
				
				$filename    = $image->getClientOriginalName();
				$image_resize = \Image::make($image->getRealPath())->save($destinationPath.$imagename);
				$data['img']=$imagename;
				
				
			}
			if(!empty($id)){
				DB::table('foods')->where('id', $id)->update($data);
				$req->session()->flash('msg', '<div class="alert alert-success">Record updated <a class="close" data-dismiss="alert">×</a> </div>');
			}else{
			    $id = DB::table('foods')->insertGetId($data);
				 
				$req->session()->flash('msg', '<div class="alert alert-success">Record Added <a class="close" data-dismiss="alert">×</a> </div>');
			}
			
			return redirect('admin/food');
		}
    }
	protected function deleteFood($id,Request $req )
    {
       
		DB::table('foods')->where('id', $id)->delete();
		  $req->session()->flash('msg', '<div class="alert alert-success">Record Deleted <a class="close" data-dismiss="alert">×</a> </div>');
	   return redirect('admin/food');
	}
	

	protected function category()
    {
       $data['records'] = DB::table('category')->get();
	   return view('admin/category',$data);
	}
	

	protected function saveCategory(Request $req )
    {
		$Category = $req->get('category');
        $id = $req->get('id');
        if (empty($Category)) {
            return redirect()->back()->withErrors(['msg' => '<div class="alert alert-danger">Category name can not be empty.<a class="close" data-dismiss="alert"></a></div>'])->withInput();
        } else {
			if ($req->hasFile('catimage')) {
				$time=time();
				$image = $req->file('catimage');
				$imagename = $time.'catimg.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/images/category/');
				
				if(!File::isDirectory($destinationPath)){
					File::makeDirectory($destinationPath, 0777, true, true);
				}
				
				$filename    = $image->getClientOriginalName();
				$image_resize = \Image::make($image->getRealPath())->save($destinationPath.$imagename);
				

				$data = ['name' => $Category];
            	$where = array(['name', '=', $Category]);
            	if (!empty($id)) {
                	$where[] = ['id', '!=', $id];
				}
				$data= ['name' => $Category,'image'=> $imagename];
            	$records = DB::table('category')->where($where)->get()->all();
            	if (!empty($records)) {
                	return redirect()->to('/admin/category')->with('msg', '<div class="alert alert-danger">Category already exist.<a class="close" data-dismiss="alert">x</a></div>');
            	} else {
                	if (!empty($id)) {
                    	DB::table('category')->where(['id' => $id])->update($data);
                    	$msg = 'Record updated.';
                	} else {
                    	DB::table('category')->insert($data);
                    	$msg = 'Record added.';
                	}
                	return redirect()->to('/admin/category')->with('msg', '<div class="alert alert-success">' . $msg . '<a class="close" data-dismiss="alert">×</a></div>');
				}
			}else{
            	return redirect()->to('/admin/category')->with('msg', '<div class="alert alert-danger">Image is required.<a class="close" data-dismiss="alert">x</a></div>');
			}
        }
	}
	

	protected function deleteCategory($id,Request $req )
    {
       
		DB::table('category')->where('id', $id)->delete();
		  $req->session()->flash('msg', '<div class="alert alert-success">Record Deleted <a class="close" data-dismiss="alert">×</a> </div>');
	   return redirect('admin/category');
	}
	

	
	protected function subcategory()
    {
       $data['records'] = DB::table('subcategory')->get();
	   return view('admin/subcategory',$data);
	}

	protected function saveSubcategory(Request $req )
    {
		$Category = $req->get('subcategory');
        $id = $req->get('id');
        if (empty($Category)) {
            return redirect()->back()->withErrors(['msg' => '<div class="alert alert-danger">Category name can not be empty.<a class="close" data-dismiss="alert"></a></div>'])->withInput();
        } else {
			if ($req->hasFile('subcatimage')) {
				$time=time();
				$image = $req->file('subcatimage');
				$imagename = $time.'subcatimg.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/images/subcategory/');
				
				if(!File::isDirectory($destinationPath)){
					File::makeDirectory($destinationPath, 0777, true, true);
				}
				
				$filename    = $image->getClientOriginalName();
				$image_resize = \Image::make($image->getRealPath())->save($destinationPath.$imagename);
				

				$data = ['name' => $Category];
            	$where = array(['name', '=', $Category]);
            	if (!empty($id)) {
                	$where[] = ['id', '!=', $id];
				}
				$data= ['name' => $Category,'image'=> $imagename];
            	$records = DB::table('subcategory')->where($where)->get()->all();
            	if (!empty($records)) {
                return redirect()->to('/admin/subcategory')->with('msg', '<div class="alert alert-danger">Category already exist.<a class="close" data-dismiss="alert">x</a></div>');
            	} else {
                	if (!empty($id)) {
                    	DB::table('subcategory')->where(['id' => $id])->update($data);
                    	$msg = 'Record updated.';
                	} else {
                    	DB::table('subcategory')->insert($data);
                    	$msg = 'Record added.';
                	}
                	return redirect()->to('/admin/subcategory')->with('msg', '<div class="alert alert-success">' . $msg . '<a class="close" data-dismiss="alert">×</a></div>');
            	}


			}else{
				return redirect()->to('/admin/category')->with('msg', '<div class="alert alert-danger">Image is required.<a class="close" data-dismiss="alert">x</a></div>');
			}
            
        }
	}
	
	
	protected function deleteSubcategory($id,Request $req )
    {
       
		DB::table('subcategory')->where('id', $id)->delete();
		  $req->session()->flash('msg', '<div class="alert alert-success">Record Deleted <a class="close" data-dismiss="alert">×</a> </div>');
	   return redirect('admin/subcategory');
    }
}
