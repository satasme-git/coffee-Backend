<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use Session;
use Redirect;
use Carbon\Carbon;

class OpenController extends Controller
{
    
    public function __construct()
    {
             $this->middleware(function ($request, $next) {
            if (Session::get("user_email") == "") {
                Redirect::to('/')->send();
            }
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $data['users'] = DB::table('system_users')
    //         ->join('roles', 'system_users.role_id', '=', 'roles.id')
    //         ->select('system_users.*', 'roles.role_name')
    //          ->where([
    //             ['system_users.status', '=', 1],
    //         ])
    //         ->get();
    //     return view('admin.viewSystemUsers', $data);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Role::all();

        return view('admin.AddUser', compact('users'));
    }    
    
    protected function open() {
             if(empty(Session::get('user_email'))){
 
            Redirect::to('/')->send();
          }else{
                $data['days'] =DB::table('open_details')->get();
        
                $data['close'] =DB::table('closed_dates')
                ->where('date' , '>=' , date('Y-m-d') )->get();
                
                return view('admin.open',$data);
          }
    }
    
    public function createTime()
    {
        // $users = Role::all();
        if(empty(Session::get('user_email'))){
 
            Redirect::to('/')->send();
          }else{
                $data['days'] =DB::table('open_details')->get();
                
                
                
                return view('admin/AddTime', $data);
          }
          

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $id = $req->get('id');
        $open = $req->get('open');
        $close = $req->get('close');
        $status = $req->get('status');
        
        $data = [
            'open' => $open,
            'close' => $close,
        ];
        
        if ($status==null){
            $data['status'] = 1;
        }
        else{
            $data['status'] = 0;
        }
        
        $update = DB::table('open_details')->where('id', $id)->update($data);
        
            if($update){
                $req->session()->flash('msg', '<div class="alert alert-success">Record updated <a class="close" data-dismiss="alert">×</a> </div>');
                return redirect('admin/editopentime');
            }
            else{
                return redirect('admin/editopentime');
            }
        
            // return redirect('admin/editopentime');
        // }
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
    
    public function addclose($id = 0, Request $req)
    {
        if (empty(Session::get('user_email'))) {

            Redirect::to('/')->send();
        } else {

        $data = [];
        if (!empty($id)) {
            $data['records'] = DB::table('closed_dates')->where('id', $id)->get()->first();

            if (empty($data['records'])) {
                return redirect('/admin/addCloseDate');
            }
        }
        return view('admin/addCloseDate', $data);
        }
    }
    
    public function add_close(Request $req)
    {
         if (empty(Session::get('user_email'))) {

            Redirect::to('/')->send();
        } else {
            
        $date = $req->get('date');
        $reason = $req->get('reason');
        $open = $req->get('open');
        $close = $req->get('close');
        $full = $req->get('full');
        $id = $req->get('id');

        if (!empty($id)) {
            
            $validationdata = array('date' => $date, 'reason' => $reason);
            $validationtype = array(
                'date' => 'required',
                'reason' => 'required',
            );

            $validator = Validator::make($validationdata, $validationtype);
            if ($validator->fails()) {
               
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $data = [
                    'date' => $date,
                    'reason' => $reason,
                    'open' => $open,
                    'close' => $close,
                ];
                if ($full==null){
                    $data['full'] = 0;
                }
                else{
                    $data['full'] = 1;
                }
                
                DB::table('closed_dates')->where('id', $id)->update($data);
                $req->session()->flash('msg', '<div class="alert alert-success">Record updated <a class="close" data-dismiss="alert">×</a> </div>');
            }

        } else {
            $validationdata = array('date' => $date, 'reason' => $reason);
            $validationtype = array(
                'date' => 'required',
                'reason' => 'required',
            );

            $validator = Validator::make($validationdata, $validationtype);

            if ($validator->fails()) {
     
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $data = [
                    'date' => $date,
                    'reason' => $reason,
                    'open' => $open,
                    'close' => $close,
                ];
                if ($full==null){
                    $data['full'] = 0;
                }
                else{
                    $data['full'] = 1;
                }
                $id = DB::table('closed_dates')->insertGetId($data);
                $req->session()->flash('msg', '<div class="alert alert-success">Record Added <a class="close" data-dismiss="alert">×</a> </div>');

            }

        }
        // dd($data);
        return redirect('admin/open');
        }
    }
    public function deleteclose($id, Request $req)
    {
        DB::table('closed_dates')->where('id', $id)->delete();;
        $req->session()->flash('msg', '<div class="alert alert-success">Boxes Deleted <a class="close" data-dismiss="alert">×</a> </div>');
        return redirect('admin/open');

    }
    public function getopendetails()
        {
        // $now = Carbon::now()->month;
        
        $now = date('l');
        // $open = DB::table('open_details')->where('id', $now)->get()->first();
        // $data = [
        //         'date' => $date,
        //         'reason' => $reason,
        //         'open' => $open,
        //         'close' => $close,
        //     ];
        
        $open = DB::table('open_details')->where('day', $now)->get()->first();
        
        return json_encode($open);
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $users = DB::table('system_users')
            ->join('roles', 'system_users.role_id', '=', 'roles.id')
            ->select('system_users.*', 'roles.role_name')
            ->where('system_users.id', $id)
            ->get()->first();
        return view('admin.updateSystemUser', compact('roles', 'users'));
    }
    
    
        
        
    public function orderHistory()
    {

        
        return json_encode('$data');
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
    public function destroy($id,Request $req)
    {
        $data = ['status' => '0',];
		DB::table('system_users')->where('id', $id)->update($data);
		$req->session()->flash('msg', '<div class="alert alert-success">Customer blacklisted <a class="close" data-dismiss="alert">×</a> </div>');
	   return redirect('admin/view_system_users');
  
    }
    // public function addUsers($id , Request $req)
    // {

    //     $data = [];
    //     if (!empty($id)) {

    //         $data['users'] = DB::table('system_users')
    //         ->join('roles', 'system_users.role_id', '=', 'roles.id')
    //         ->select('system_users.*', 'roles.role_name')
    //         ->where('system_users.id',$id)
    //         ->get()->first();

    //         return view('/admin/AddUser', $data);
    //     }
    //     // return view('/admin/AddUser', $data);
    // }

}
