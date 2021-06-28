<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;
use Session;
use Validator;

class StyleController extends Controller
{

    public function __construct()
    {
        // if(empty(Session::get('user_email'))){

        //     Redirect::to('/')->send();
        //   }
    }
    protected function slides()
    {

        $records = DB::table('slides')->get()->all();
        return view('admin/slides', ['records' => $records]);

    }

    protected function addslides($id)
    {
		
        $data = [];
        if (!empty($id)) {
            $data['slides'] = DB::table('slides')->where('id', $id)->get()->first();

            if (empty($data['slides'])) {
                return redirect('/admin/slides');
            }
        }
        return view('admin/AddSlide', $data);

    }

 
    protected function saveslides(Request $req)
    {
		
        $id = $req->get('id');
        $description = $req->get('description');
        $image = $req->file('thumb');

        if (!empty($id)) {
            $validationdata = array('description' => $description);
            $validationtype = array('description' => 'required');

            $validator = Validator::make($validationdata, $validationtype);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $data = [
					'description' => $description,
				];
				$time = time();
                if ($req->hasFile('thumb')) {
                    $image = $req->file('thumb');
                    $imagename = $time . '_thumb.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/work/public/images/slides');

                    if (!File::isDirectory($destinationPath)) {
                        File::makeDirectory($destinationPath, 0777, true, true);
                    }

                    $filename = $image->getClientOriginalName();
                    $image_resize = \Image::make($image->getRealPath())->save($destinationPath . $imagename);
                    $data['thumb'] = $imagename;

                }

			

                DB::table('slides')->where('id', $id)->update($data);
                $req->session()->flash('msg', '<div class="alert alert-success">Record updated <a class="close" data-dismiss="alert">×</a> </div>');
            }
        } else {
            $validationdata = array('thumb'=>$image,'description' => $description);
            $validationtype = array('thumb'=> 'required','description' => 'required');

            $validator = Validator::make($validationdata, $validationtype);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
				$data = [
					'description' => $description,
				];
				$time = time();
                if ($req->hasFile('thumb')) {
                    $image = $req->file('thumb');
                    $imagename = $time . '_thumb.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/work/public/images/slides');

                    if (!File::isDirectory($destinationPath)) {
                        File::makeDirectory($destinationPath, 0777, true, true);
                    }

                    $filename = $image->getClientOriginalName();
                    $image_resize = \Image::make($image->getRealPath())->save($destinationPath . $imagename);
                    $data['thumb'] = $imagename;

                }
                $id = DB::table('slides')->insertGetId($data);
                $req->session()->flash('msg', '<div class="alert alert-success">Record Added <a class="close" data-dismiss="alert">×</a> </div>');
            }
        }

        return redirect('admin/slides');
    }

    protected function deleteslides($id = 0, Request $req)
    {

        if (!empty($id)) {
            DB::table('slides')->where('id', $id)->delete();
            return redirect()->to('/admin/slides')->with('msg', '<div class="alert alert-success">Record deleted.<a class="close" data-dismiss="alert">×</a></div>.');
        } else {
            return redirect()->to('/admin/slides')->with('msg', '<div class="alert alert-success">Invalid record.<a class="close" data-dismiss="alert">×</a></div>');
        }

    }

    protected function getslides()
    {

        $records = DB::table('slides')->get()->all();
        return json_encode($records);

    }

}
