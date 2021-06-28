<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        // if(empty(Session::get('user_email'))){

        //     Redirect::to('/')->send();
        //   }
    }
    protected function newOrder(Request $req)
    {
// status 0=order cancelled
        // status 1=new order
        // status 2=payment completed
        // status 3=free coffee

        $userid = $req->get('user_id');
        $getfoods = $req->input('foods');
        $total = 0;
        // $time=time();
        $datenow = Carbon::now()->toDateTimeString();
        $datesub = explode(' ', trim($datenow))[0];
        $timesub = explode(' ', trim($datenow))[1];
        $time = str_replace(':', '', $timesub);
        $datefull = str_replace('-', '', $datesub);
        $date = substr($datefull, 2, 8);
        $orderid = "" . $time . $date;
        foreach ($getfoods as $foods => $key) {
            $prid = $key['product_id'];
            $priceget = DB::table('foods')
                ->where('id', $prid)
                ->first();
            $price = $priceget->price;
            $qty = $key['qty'];
            $total += ($price * $qty);
        }

        // $qty=$foods[1];

        // dd($userid);
        $orderdata = [

            'orderid' => $orderid,
            'total' => $total,
            'status' => '1',
            'users_id' => $userid,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ];

        $ordersid = DB::table('orders')->insertGetId($orderdata);

        foreach ($getfoods as $foods => $key) {
            $prid = $key['product_id'];
            $priceget = DB::table('foods')
                ->where('id', $prid)
                ->first();
            $price = $priceget->price;
            $qty = $key['qty'];
            $fooddata = [
                'foods_id' => $prid,
                'qty' => $qty,
                'price' => $price,
                'orders_id' => $ordersid,
            ];
            $orderfoodid = DB::table('order_foods')->insertGetId($fooddata);
        }
        if (empty($orderfoodid)) {
            $resp = "failed to execute";
        } else {
            $resp = "success";
        }

        return json_encode($resp);
    }

    protected function testOrder(Request $req)
    {
        return "dasdasdasd";
        //    return json_encode($req);
    }

    public function register(Request $request)
    {

        /* Taking all data from POST */
        // $userData = array(
        //   'name'    =>  $req->get('cus_name'),
        //   'email'   =>  $req->get('cus_email'),
        //   'mobile_no'      =>  $req->get('cus_mobile_number'),
        //   'password'     =>     $req->get('cus_password')
        // );

        //     $userData['password'] = Hash::make($userData['password']);
        //     $userData['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
        //     $userdata['status']='0';

        //     /* Inserting into the user table */
        //     $id = DB::table('users')->insertGetId($userData);
        //     $usersendData = array(
        //         'userid'      =>   $id,
        //         'name'     =>   $req->get('cus_name'),
        //         'email'   =>  $req->get('cus_email')
        //       );

        // foreach($get_result_arr as $result){
        //     $lists = $result->abc;
        // }

        // dd(json_decode($request->getContent(), true));

        // $postbody =count($request->json()->all());
        // for($i=0;$i< $postbody;$i++){
        //     echo $request[$i]['cId']."<br/>";
        // }
        // $person = json_decode($request);

        // foreach (json_decode($request) as $area) {
        //     print_r($area); // this is your area from json response
        // }
        // $userid = $request[0]->cId;
        // return count($request->json()->all());
        // return $person[0]->cId;

        $get_result_arr = json_decode($request->getContent(), true);

        $cus_id = $get_result_arr['cus_id'];
        $order_id = $get_result_arr['order_id'];
        $order_total = $get_result_arr['order_total'];
        $payment_method = $get_result_arr['payment_method'];

        $orderdata = [

            'orderid' => $order_id,
            'total' => $order_total,
            'status' => '1',
            'users_id' => $cus_id,
            'payment_method' => $payment_method,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ];

        $ordersid = DB::table('orders')->insertGetId($orderdata);
        $i = 0;

        foreach ($get_result_arr['result'] as $list) {

            $pId = $list['pId'];
            $pPrice = $list['pPrice'];
            $ordersid = $ordersid;
            $pQty = $list['pQty'];
            $fooddata = [
                'foods_id' => $pId,
                'qty' => $pQty,
                'price' => $pPrice,
                'orders_id' => $ordersid,
            ];
            $orderfoodid = DB::table('order_foods')->insertGetId($fooddata);
            $j = 0;
            foreach ($get_result_arr['cart_details'] as $list2) {
                if ($i == $j) {
                    $tId = $list2['tId'];
                    $pId = $list2['pId'];

                    $pSize = $list2['pSize'];
                    $pFcream = $list2['pFcream'];
                    $pSkim = $list2['pSkim'];
                    $pSoy = $list2['pSoy'];
                    $pAlmond = $list2['pAlmond'];
                    $pOat = $list2['pOat'];

                    $ordersid = $ordersid;
                    $orderfoodid = $orderfoodid;
                    $fooddatatop = [
                        'tId' => $tId,
                        'pId' => $pId,
                        'pSize' => $pSize,
                        'pFcream' => $pFcream,
                        'pSkim' => $pSkim,
                        'pSoy' => $pSoy,
                        'pAlmond' => $pAlmond,
                        'pOat' => $pOat,
                        'order_id' => $ordersid,
                        'order_foods_id' => $orderfoodid,

                    ];
                    $orderfoodid = DB::table('order_items_topins')->insertGetId($fooddatatop);

                }
                $j++;

            }

            $i++;

        }

        return json_encode($fooddata);
    }
   

}
