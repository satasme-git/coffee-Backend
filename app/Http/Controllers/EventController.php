<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Redirect;
use Session;
use Validator;

class EventController extends Controller
{
    public function __construct()
    {
        // if(empty(Session::get('user_email'))){

        //     Redirect::to('/')->send();
        //   }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Events::all();
        return json_encode($expenses);
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
    public function viewAll()
    {
        $data['events'] = DB::table('events')->where('status', 1)->get();
        return view('admin/events', $data);
    }
    public function addevents($id = 0, Request $req)
    {
        $data = [];
        if (!empty($id)) {
            $data['records'] = DB::table('events')->where('id', $id)->get()->first();

            if (empty($data['records'])) {
                return redirect('/admin/addEvent');
            }
        }
        return view('admin/addEvent', $data);
    }
    public function add_Events(Request $req)
    {
        $title = $req->get('title');
        $description = $req->get('description');
        $id = $req->get('id');
        $image = $req->file('event');

        if (!empty($id)) {
            $validationdata = array('title' => $title, 'description' => $description);
            $validationtype = array('title' => 'required', 'description' => 'required');

            $validator = Validator::make($validationdata, $validationtype);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $data = [
                    'title' => $title,
                    'description' => $description,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'status' => 1,
                ];
                $time = time();
                if ($req->hasFile('event')) {
                    $image = $req->file('event');
                    $imagename = $time . 'cfimg.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/images/Events/');

                    if (!File::isDirectory($destinationPath)) {
                        File::makeDirectory($destinationPath, 0777, true, true);
                    }

                    $filename = $image->getClientOriginalName();
                    $image_resize = \Image::make($image->getRealPath())->save($destinationPath . $imagename);
                    $data['event_image'] = $imagename;

                }
                DB::table('events')->where('id', $id)->update($data);
                $req->session()->flash('msg', '<div class="alert alert-success">Record updated <a class="close" data-dismiss="alert">×</a> </div>');
            }
        } else {
            $validationdata = array('title' => $title, 'description' => $description, 'event' => $image);
            $validationtype = array('title' => 'required', 'description' => 'required', 'event' => 'required');

            $validator = Validator::make($validationdata, $validationtype);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $data = [
                    'title' => $title,
                    'description' => $description,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'status' => 1,
                ];
                $time = time();
                if ($req->hasFile('event')) {
                    $image = $req->file('event');
                    $imagename = $time . 'cfimg.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/images/Events/');

                    if (!File::isDirectory($destinationPath)) {
                        File::makeDirectory($destinationPath, 0777, true, true);
                    }

                    $filename = $image->getClientOriginalName();
                    $image_resize = \Image::make($image->getRealPath())->save($destinationPath . $imagename);
                    $data['event_image'] = $imagename;

                }

                $id = DB::table('events')->insertGetId($data);
                $req->session()->flash('msg', '<div class="alert alert-success">Record Added <a class="close" data-dismiss="alert">×</a> </div>');

            }
        }
        return redirect('admin/viewEvents');

    }
    public function deleteEventss($id, Request $req)
    {
        $data = ['status' => '0'];
        DB::table('events')->where('id', $id)->update($data);
        $req->session()->flash('msg', '<div class="alert alert-success">Event Deleted <a class="close" data-dismiss="alert">×</a> </div>');
        return redirect('admin/viewEvents');
    }
}
