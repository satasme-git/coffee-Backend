<?php

namespace App\Http\Controllers;
use App\Models\Box;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Validator;
use File;
use Session;
use Redirect;
class BoxesController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getAllBoxes()
    {
        // $boxes = Box::all();
          $boxes = DB::table('boxes')
        ->select('boxes.*')
         ->where([
            ['status', '=', 1],
        ])
        ->get();
        return json_encode($boxes);
    }
    public function getFirstresiBoxes()
    {
        $boxes = DB::table('boxes')->limit(1)->get();
        return json_encode($boxes);
    }
    
 
    public function viewAll()
    {
        if (empty(Session::get('user_email'))) {

            Redirect::to('/')->send();
        } else {
        $data['boxes'] = DB::table('foods')
        ->where([
            ['status', '=', 1],
            ['subcategory_id', '=', 9]
        ])
        ->get();
        return view('admin/boxes', $data);
        }
    }
    public function addboxes($id = 0, Request $req)
    {
        if (empty(Session::get('user_email'))) {

            Redirect::to('/')->send();
        } else {

        $data = [];
        if (!empty($id)) {
            $data['records'] = DB::table('foods')->where('id', $id)->get()->first();

            if (empty($data['records'])) {
                return redirect('/admin/addBoxes');
            }
        }
        return view('admin/addBoxes', $data);
        }
    }
    public function add_boxes(Request $req)
    {
         if (empty(Session::get('user_email'))) {

            Redirect::to('/')->send();
        } else {
            $name = $req->get('name');
            $title = $req->get('title');
            $price = $req->get('price');
            $description = $req->get('description');
            $id = $req->get('id');
            $image = $req->file('box');

        if (!empty($id)) {
            
            $validationdata = array('price' => $price, 'name' => $name, 'title' => $title, 'description' => $description);
            $validationtype = array(
                'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
                'name' => 'required',
                'title' => 'required',
                'description' => 'required',
            );

            $validator = Validator::make($validationdata, $validationtype);
            if ($validator->fails()) {
               
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $data = [
                    'name' => $name,
                    'title' => $title,
                    'price' => $price,
                    'description' => $description,
                    'subcategory_id' =>9,
                    'status' => 1,
                ];
                $time = time();
                if ($req->hasFile('box')) {
                    $image = $req->file('box');
                    $imagename = $time . 'cfimg.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/images/Box/');

                    if (!File::isDirectory($destinationPath)) {
                        File::makeDirectory($destinationPath, 0777, true, true);
                    }

                    $filename = $image->getClientOriginalName();
                    $image_resize = \Image::make($image->getRealPath())->save($destinationPath . $imagename);
                    $data['img'] = $imagename;

                }
                DB::table('foods')->where('id', $id)->update($data);
                $req->session()->flash('msg', '<div class="alert alert-success">Record updated <a class="close" data-dismiss="alert">×</a> </div>');
            }

        } else {
            $validationdata = array('price' => $price, 'name' => $name, 'title' => $title, 'description' => $description, 'box' => $image);
            $validationtype = array(
                'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
                'name' => 'required',
                'title' => 'required',
                'description' => 'required',
                'box' => 'required');

            $validator = Validator::make($validationdata, $validationtype);

            if ($validator->fails()) {
     
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $data = [
                    'name' => $name,
                    'title' => $title,
                    'price' => $price,
                    'description' => $description,
                    'subcategory_id' =>9,
                    'status' => 1,
                ];
                $time = time();
                if ($req->hasFile('box')) {
                    $image = $req->file('box');
                    $imagename = $time . 'cfimg.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/images/Box/');

                    if (!File::isDirectory($destinationPath)) {
                        File::makeDirectory($destinationPath, 0777, true, true);
                    }

                    $filename = $image->getClientOriginalName();
                    $image_resize = \Image::make($image->getRealPath())->save($destinationPath . $imagename);
                    $data['img'] = $imagename;

                }
                $id = DB::table('foods')->insertGetId($data);
                $req->session()->flash('msg', '<div class="alert alert-success">Record Added <a class="close" data-dismiss="alert">×</a> </div>');

            }

        }
        return redirect('admin/viewBoxes');
        }
    }
    public function deleteBoxes($id, Request $req)
    {
        $data = ['status' => '0'];
        DB::table('foods')->where('id', $id)->update($data);
        $req->session()->flash('msg', '<div class="alert alert-success">Boxes Deleted <a class="close" data-dismiss="alert">×</a> </div>');
        return redirect('admin/viewBoxes');

    }
}
