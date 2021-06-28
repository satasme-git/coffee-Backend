<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Session;
use Redirect;
class OrderBoxController extends Controller
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
    public function insertOrder(Request $request){
                $get_result_arr = json_decode($request->getContent(), true);

        $cus_id = $get_result_arr['cus_id'];
        $order_id = $get_result_arr['order_id'];
        $order_total = $get_result_arr['order_total'];
        $payment_method = $get_result_arr['payment_method'];
        $bCategory = $get_result_arr['bCategory'];

        $orderdata = [

            'orderid' => $order_id,
            'total' => $order_total,
            'status' => '1',
            'users_id' => $cus_id,
            'payment_method' => $payment_method,
            'category' => $bCategory,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ];

        $ordersid = DB::table('order_box')->insertGetId($orderdata);
        // $i = 0;

        foreach ($get_result_arr['result'] as $list) {

            $pId = $list['bId'];
            $pPrice = $list['bPrice'];
            // $ordersid = $ordersid;
            $pQty = $list['bQty'];
            $fooddata = [
                'bId' => $pId,
                'bQty' => $pQty,
                'bPrice' => $pPrice,
                'orders_box_id' => $ordersid,
            ];
            $orderfoodid = DB::table('order_box_details')->insertGetId($fooddata);
   
        }

        return json_encode($orderdata);
    }
     public function AllBoxOrders()
    {
        $data['order_bxes'] = DB::table('order_box')
                ->join('users', 'order_box.users_id', '=', 'users.id')
                ->select('order_box.*', 'users.name', 'users.mobile_no')
                ->get();
        return view('admin/OrderBox',$data);

    }
    protected function viewBoxItems($id, Request $req)
    {
   
        $orders = DB::table('order_box')
            ->join('users', 'users.id', '=', 'order_box.users_id')
            ->select('order_box.*', 'users.name', 'users.mobile_no')
            ->where('order_box.id', $id)
            ->get();
        foreach ($orders as $order) {
			$items = DB::table('order_box_details')
			->join('boxes', 'order_box_details.bId', '=', 'boxes.id')
			->select('boxes.box_image','boxes.id','boxes.box_title','boxes.box_description', 'order_box_details.*')
            ->where('order_box_details.orders_box_id', $id)
            ->get();

          
        }


        return view('admin/orderBoxItemView', compact('orders','items'));
    }
     public function purchaseOrder($id, Request $req){
   
        $updateorder = ['status' => '2'];
        DB::table('order_box')->where(['id' => $id])->update($updateorder);
        return redirect()->to('/admin/order_box')->with('msg', '<div class="alert alert-success">Successfully purchased.<a class="close" data-dismiss="alert">x</a></div>');
    }
     public function searchByMobileNumber(Request $request)
    {
        $order_count = DB::table('order_box')
            ->join('users', 'users.id', '=', 'order_box.users_id')
            ->where([
                'users.mobile_no' => $request->id,
                'order_box.status' => 1,
            ])
            ->get()->count();

        if ($order_count == 1) {
            $orders = DB::table('order_box')
                ->join('users', 'users.id', '=', 'order_box.users_id')
                ->select('order_box.*', 'users.name', 'users.mobile_no')
                ->where(
                    [
                        'users.mobile_no' => $request->id,
                        'order_box.status' => 1,
                    ])
                ->get();

            foreach ($orders as $order) {
                $items = DB::table('order_box_details')
                    ->join('boxes', 'order_box_details.bId', '=', 'boxes.id')
                    ->select('boxes.box_image', 'boxes.id', 'boxes.box_title', 'boxes.box_description', 'order_box_details.*')
                    ->where('order_box_details.orders_box_id', $order->id)
                    ->get();

            }

            return view('admin/orderBoxItemView', compact('orders', 'items'));

        } elseif ($order_count > 1) {
            $data['order_bxes'] = DB::table('order_box')
                ->join('users', 'users.id', '=', 'order_box.users_id')
                ->select('order_box.*', 'users.name', 'users.mobile_no')
                ->where(
                    [
                        'users.mobile_no' => $request->id,
                        'order_box.status' => 1,
                    ])
                ->get();

            return view('admin/orderBoxBycustomer',$data);
        } elseif ($order_count == 0) {
            return view('admin/errorOrder');
        }

    }
}
