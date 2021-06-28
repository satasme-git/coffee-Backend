<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use Session;
use Redirect;
class SystemUserController extends Controller
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
    public function index()
    {
        $data['users'] = DB::table('system_users')
            ->join('roles', 'system_users.role_id', '=', 'roles.id')
            ->select('system_users.*', 'roles.role_name')
             ->where([
                ['system_users.status', '=', 1],
            ])
            ->get();
        return view('admin.viewSystemUsers', $data);
    }

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $user_fname = $req->get('user_fname');
        $user_lname = $req->get('user_lname');
        $user_nic = $req->get('user_nic');
        $user_dob = $req->get('user_dob');
        $username = $req->get('username');
        $role_id = $req->get('role_id');
        $id = $req->get('id');

        $validationdata = array('user_fname' => $user_fname, 'user_lname' => $user_lname, 'user_nic' => $user_nic, 'user_dob' => $user_dob, 'username' => $username, 'role_id' => $role_id);
        $validationtype = array('user_fname' => 'required', 'user_lname' => 'required', 'user_nic' => 'required', 'user_dob' => 'required|not_in:0|date|date_format:Y-m-d|before:yesterday', 'username' => 'required', 'role_id' => 'required');

        $validator = Validator::make($validationdata, $validationtype);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $data = [
                'suser_fname' => $user_fname,
                'suser_flname' => $user_lname,
                'suser_nic' => $user_nic,
                'suser_dob' => $user_dob,
                'suser_username' => $username,
                'suser_password' => Hash::make(123),
                'role_id' => $role_id,
                'status' => 1,
            ];
            if (!empty($id)) {

                DB::table('system_users')->where('id', $id)->update($data);
                $req->session()->flash('msg', '<div class="alert alert-success">Record updated <a class="close" data-dismiss="alert">×</a> </div>');
            } else {

                $users = DB::table('system_users')
                    ->join('roles', 'system_users.role_id', '=', 'roles.id')
                    ->select('system_users.*', 'roles.role_name')
                    ->where([
                        ['system_users.suser_nic', '=', $user_nic],
                        ['system_users.status', '=', 1],
                    ])
                    ->get()->first();
                if (!empty($users)) {
                    $roles = Role::all();
                    
                    $req->session()->flash('msg', '<div class="alert alert-warning">Record Already in the database <a class="close" data-dismiss="alert">×</a> </div>');
                    return view('admin.updateSystemUser', compact('roles', 'users'));
                } else {

                    $id = DB::table('system_users')->insertGetId($data);
                    $req->session()->flash('msg', '<div class="alert alert-success">Record Added <a class="close" data-dismiss="alert">×</a> </div>');
                }
            }
            return redirect('admin/view_system_users');
        }
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
        $roles = Role::all();
        $users = DB::table('system_users')
            ->join('roles', 'system_users.role_id', '=', 'roles.id')
            ->select('system_users.*', 'roles.role_name')
            ->where('system_users.id', $id)
            ->get()->first();
        return view('admin.updateSystemUser', compact('roles', 'users'));
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
