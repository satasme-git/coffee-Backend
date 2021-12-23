<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\Orders;

use Illuminate\Support\Facades\Hash;
use Validator;
use File;
use Session;
use Redirect;

class DashboardController extends Controller
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
	protected function index()
    {
        $orders  = DB::table( 'orders' )
        ->Join( 'users', 'orders.users_id', '=', 'users.id' )
        ->select( 'orders.*', 'users.name as user_name', 'users.email' )
        ->where([
            // ['status', '=', 1],
            ['orders.status', '!=', 10]
        ])
        ->orderBy('orders.id', 'DESC')
        ->limit(5)
        ->get();
        return view('admin/Dashboard',compact('orders'));
	   
	}
    public function monthlyCollection() {

        $orders = Orders::select(
            DB::raw('sum(total) as sums'), 
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
            )
            ->groupBy('months')
            ->get();
    
        

        $data = [];
    
        foreach ($orders as $key => $value) {
      
                    $data[] = ['id' => $value->id, 'value' => $value->loan_number, 'sums' => $value->sums, 'months' => $value->months,
                            // 'blockNo'=>$value->blockNo,
                    ];
               
        }
       
        return response($data);
    
    
        // echo $orders;
    
    }
    public function todayOrders() {
        $ldate = date('Y-m-d');
          $Collections = Orders::select(
                DB::raw('sum(total) as order_total')
                )
                ->where( [
                    ['orders.status', '!=', 10],

                ] )
                ->whereDate('created_at', '=', date('Y-m-d'))
                ->get();
  
            
        $data = [];
        foreach ($Collections as $key => $value) {
                $data[] = [ 'order_total' => $value->order_total];
        }
        
        return response($data);
    }
    public function todayOrdersCount() {
 
        $Collections =DB::table('orders')
        ->select(DB::raw('count(*) as orders_count'))
        ->where( [
            ['orders.status', '!=', 10]
        ] )
        ->whereDate('created_at', '=', date('Y-m-d'))
        ->get();

        
  
            
        $data = [];
        foreach ($Collections as $key => $value) {
                $data[] = [ 'orders_count' => $value->orders_count];
        }
        
        return response($data );
    }
	public function monthlyrevenue() {
  
        $Collections = Orders::select(
            DB::raw('sum(total) as order_revenue')
            )
            ->where( [
                ['orders.status', '!=', 10],

            ] )
            ->whereYear('created_at', '=', date('Y'))
            ->whereMonth('created_at', '=', date('m'))
            ->get();
            
        $data = [];
        foreach ($Collections as $key => $value) {
                $data[] = [ 'order_revenue' => $value->order_revenue];
        }
        
        return response( $data);
    }
     public function total_customers() {
 
        $Collections =DB::table('users')
        ->select(DB::raw('count(*) as active_customers'))
        ->where( [
            ['users.status', '!=', 1]
        ] )
        ->get();

        
  
            
        $data = [];
        foreach ($Collections as $key => $value) {
                $data[] = [ 'active_customers' => $value->active_customers];
        }
        
        return response($data );
    }
    public function card_orders() {
 
        $Collections =DB::table('orders')
        ->select(DB::raw('count(*) as card_orders' ))
        ->where( [
            ['orders.status', '!=', 10],
            ['orders.payment_method', '=', "Card"]
        ] )
        ->get();  
        $data = [];
        foreach ($Collections as $key => $value) {
                $data[] = [ 'card_orders' => $value->card_orders];
        }
        
        return response($data );
    } 
     public function cash_orders() {
 
        $Collections =DB::table('orders')
        ->select(DB::raw('count(*) as cash_orders' ))
        ->where( [
            ['orders.status', '!=', 10],
            ['orders.payment_method', '=', "Cash"]
        ] )
        ->get();  
        $data = [];
        foreach ($Collections as $key => $value) {
                $data[] = [ 'cash_orders' => $value->cash_orders];
        }
        
        return response($data );
    }
    
	
}
