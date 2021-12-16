<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderFoods;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Redirect;
class OrderControllerAdmin extends Controller
{
    public function __construct()
    {
        // if(empty(Session::get('user_email'))){
 
        //     Redirect::to('/')->send();
        //   }
        //     $this->middleware(function ($request, $next) {
        //     if (Session::get("user_email") == "") {
        //         Redirect::to('/')->send();
        //     }
        //     return $next($request);
        // });
    }

    protected function orders()
    {
        //    $fetchdata['orders'] = DB::table('orders')
        //    ->join('order_foods', 'orders.id', '=','order_foods.orders_id' )
        //    ->join('foods', 'foods.id', '=','order_foods.foods_id' )
        //    ->select('orders.*', 'order_foods.qty as itemqty', 'order_foods.price as itemprice', 'foods.name as food')
        //    ->get()->all();
        //    $orderid=0;
        //    $data['orders']=array();
        //    $count=0;
        //    foreach($fetchdata['orders'] as $orders){
        //         if($orders->orderid ==$orderid){
        //             $data['orders'][$orderid].push($orders);
        //         }else{
        //             $count++;
        //             $data['orders']=['orderid'=>$orders->orderid,$orders];
        //         }
        //         $qty=$orders->itemqty;
        //    }
        //    dd($count);

        // $data['orders']=OrderFoods::get()->first();

        // $data['orders']=Orders::join ('orders', 'user.schedule_id', '=', 'schedules.id')
        //     ->select ('users.id')
        //     ->orderBy ('schedules.date')
        //     ->get ()->toArray ();

        // $data['orders']=Orders::with (['orderfoods'])->get()->all();
        
         $data['orders']= DB::table('orders')
           ->join('users', 'users.id', '=', 'orders.users_id')
            ->select('orders.*','users.name','users.mobile_no')
            ->where('orders.status','!=',10)
            ->get();
        

            
        
        // $data['orders'] = Orders::get()->all();

            // dd($data);
        return view('admin/orders', $data);
    }

    protected function viewFoods($id, Request $req)
    {
        // $data['orders1'] = Orders::with(
        //     ['orderfoods'])
        //     ->where('id', $id)->get()->all();

        // return $data;
        //  dd($data);
        //  return view('admin/viewFood',$data);

        //  $orders = [];
        $orders = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.users_id')
            ->select('orders.*', 'users.name', 'users.mobile_no')
            ->where('orders.id', $id)
            ->get();
        foreach ($orders as $order) {
			$items = DB::table('order_foods')
			->join('foods', 'order_foods.foods_id', '=', 'foods.id')
			->join('order_items_topins', 'order_foods.id', '=', 'order_items_topins.order_foods_id')
			->select('foods.img','foods.id','foods.name','foods.description','foods.subcategory_id', 'order_foods.*','order_items_topins.*')
            ->where('order_foods.orders_id', $id)
            ->get();

            // $items = OrderFoods::where('orders_id', $order->id)->get();

            // foreach ($items as $item) {
            //     $productname = OrderFoods::where('id', $item->product_id)->get();
            //     // $attribute = Atribute::where('item_id', $item->id)->get();
            // }
        }

// return $items;
        return view('admin/viewFood', compact('orders','items'));
    }

    protected function purchaseOrder($id, Request $req)
    {
        // dd("ok");
        $dat['orders'] = Orders::with(['orderfoods'])->where('id', $id)->get()->all();
        $qty = 0;
        foreach ($dat['orders'] as $orders) {
            $userid = $orders->users_id;
            foreach ($orders->orderfoods as $orderfoods) {
                $qty += $orderfoods->qty;
            }
        }
        $check = DB::table('order_points')
            ->where('users_id', $userid)
            ->where('status', 'Active')
            ->select(DB::raw('sum(points) as points'))
            ->get();
        $orderid = $id;
        $pointid = 1;
        // dd(response()->json($check));
        $encode = json_encode($check);
        $crrpoints = 0;
        foreach ($check as $point) {
            $crrpoints += $point->points;
        }
        if ($pointid == 1 && $crrpoints > 250) {
            return redirect()->back()->with('alert', 'Deleted!');
        } else {
            $totalpoints = 50 * $qty;
            $data = ['orders_id' => $orderid, 'users_id' => $userid, 'point_id' => $pointid, 'points' => $totalpoints, 'created_at' => \Carbon\Carbon::now()->toDateTimeString(), 'status' => 'Active'];
            $pid = DB::table('order_points')->insertGetId($data);
            if (empty($pid)) {
                return redirect()->to('/admin/orders')->with('msg', '<div class="alert alert-danger">Error while executing.<a class="close" data-dismiss="alert">x</a></div>');
            } else {
                $updateorder = ['status' => '2'];
                DB::table('orders')->where(['id' => $orderid])->update($updateorder);
                return redirect()->to('/admin/orders')->with('msg', '<div class="alert alert-success">Successfully purchased.<a class="close" data-dismiss="alert">x</a></div>');
            }
        }
        //    dd($pid);

    }

    protected function denyFreeCofee($id, Request $req)
    {
        $dat['orders'] = Orders::with(['orderfoods'])->where('id', $id)->get()->all();
        $qty = 0;
        foreach ($dat['orders'] as $orders) {

            $userid = $orders->users_id;
            foreach ($orders->orderfoods as $orderfoods) {
                $qty += $orderfoods->qty;
            }
        }
        $orderid = $id;
        $pointid = 1;
        $totalpoints = 50 * $qty;
        $data = ['orders_id' => $orderid, 'users_id' => $userid, 'point_id' => $pointid, 'points' => $totalpoints, 'created_at' => \Carbon\Carbon::now()->toDateTimeString(), 'status' => 'Active'];
        $pid = DB::table('order_points')->insertGetId($data);
        if (empty($pid)) {
            return redirect()->to('/admin/orders')->with('msg', '<div class="alert alert-danger">Error while executing.<a class="close" data-dismiss="alert">x</a></div>');
        } else {
            $updateorder = ['status' => '2'];
            DB::table('orders')->where(['id' => $orderid])->update($updateorder);
            return redirect()->to('/admin/orders')->with('msg', '<div class="alert alert-success">Successfully purchased.<a class="close" data-dismiss="alert">x</a></div>');
        }
    }

    protected function AcceptFreeCofee($id, Request $req)
    {
        $dat['orders'] = Orders::with(['orderfoods'])->where('id', $id)->get()->all();
        $qty = 0;
        foreach ($dat['orders'] as $orders) {
            $userid = $orders->users_id;
            foreach ($orders->orderfoods as $orderfoods) {
                $qty += $orderfoods->qty;
            }
        }
        $orderid = $id;
        $pointid = 1;
        $totalpoints = 50 * ($qty - 1);
        $data = ['orders_id' => $orderid, 'users_id' => $userid, 'point_id' => $pointid, 'points' => $totalpoints, 'created_at' => \Carbon\Carbon::now()->toDateTimeString(), 'status' => 'Active'];
        $pid = DB::table('order_points')->insertGetId($data);
        if (empty($pid)) {
            return redirect()->to('/admin/orders')->with('msg', '<div class="alert alert-danger">Error while executing.<a class="close" data-dismiss="alert">x</a></div>');
        } else {
            $updateorder = ['status' => '3'];
            DB::table('orders')->where(['id' => $orderid])->update($updateorder);

            $check = DB::table('order_points')
                ->where('users_id', $userid)
                ->where('status', 'Active')
                ->get();

            $deductpoints = 0;
            $round1 = true;
            foreach ($check as $point) {
                $deductpoints += $point->points;
                if ($round1) {
                    $updatepoints = ['status' => 'Used'];
                    DB::table('order_points')->where(['id' => $point->id])->update($updatepoints);
                    $round1 = false;
                } else {
                    if ($deductpoints <= 250) {
                        $updatepoints = ['status' => 'Used'];
                        DB::table('order_points')->where(['id' => $point->id])->update($updatepoints);
                    }
                }

            }

            return redirect()->to('/admin/orders')->with('msg', '<div class="alert alert-success">Successfully purchased.<a class="close" data-dismiss="alert">x</a></div>');
        }
    }
     public function searchByMobileNumber(Request $request)
    {
        $order_count = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.users_id')
            ->where([
                'users.mobile_no' => $request->id,
                'orders.status' => 1,
            ])
            ->get()->count();

           

        if ($order_count == 1) {
            $orders = DB::table('orders')
                ->join('users', 'users.id', '=', 'orders.users_id')
                ->select('orders.*', 'users.name', 'users.mobile_no')
                ->where(
                    [
                        'users.mobile_no' => $request->id,
                        'orders.status' => 1,
                    ])
                ->get();

            foreach ($orders as $order) {
                    
                    
                $items = DB::table('order_foods')
        			->join('foods', 'order_foods.foods_id', '=', 'foods.id')
        			->join('order_items_topins', 'order_foods.id', '=', 'order_items_topins.order_foods_id')
        			->select('foods.img','foods.id','foods.name','foods.description', 'order_foods.*','order_items_topins.*')
                    ->where('order_foods.orders_id', $order->id)
                    ->get();
            
            
            
            }
            return view('admin/viewFood', compact('orders', 'items'));
        } elseif ($order_count > 1) {
            $data['orders'] = DB::table('orders')
                ->join('users', 'users.id', '=', 'orders.users_id')
                ->select('orders.*', 'users.name', 'users.mobile_no')
                ->where(
                    [
                        'users.mobile_no' => $request->id,
                        'orders.status' => 1,
                    ])
                ->get();
   
            return view('admin/orderByCustomer',$data);
        }elseif ($order_count == 0) {
            return view('admin/errorOrder');
        }

    }

}
