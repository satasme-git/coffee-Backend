<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Redirect;
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
            'payment_method' =>$payment_method,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ];

        $ordersid = DB::table('orders')->insertGetId($orderdata);
$i=0;
   
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
         $j=0;
                    foreach ($get_result_arr['cart_details'] as $list2) {
                         if($i==$j){
                            $tId= $list2['tId'];
                            $pId = $list2['pId'];
                  
                            $pSize = $list2['pSize'];
                            $pFcream = $list2['pFcream'];
                            $pSkim = $list2['pSkim'];
                            $pSoy = $list2['pSoy'];
                            $pAlmond = $list2['pAlmond'];
                            $pOat = $list2['pOat'];
                            
                            $ordersid= $ordersid;
                            $orderfoodid= $orderfoodid;
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
    
        
       public function orderHistory($id)
    {

        $orders = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.users_id')
            ->select('orders.*')
            ->where(
                [
                    'orders.users_id' => $id,
                    // 'orders.status' => 1,
                ])
            ->orderBy('orders.id', 'DESC')
            ->limit(10)
            ->get();

        $data = [];
        $items = [];
        $subcategory = DB::table('subcategory')->get()->all();
        foreach ($orders as $order) {
            unset($details);
            $id = $order->id;
            $orderid = $order->orderid;
            $total = $order->total;
            $user =$order->users_id;
            $payment_method =$order->payment_method;
            $date =$order->created_at;
            $order_status=$order->status;
          $details = DB::table('order_foods')
                ->join('foods', 'foods.id', '=', 'order_foods.foods_id')
                ->select('order_foods.*','foods.img','foods.name','foods.description')
                ->where('order_foods.orders_id', $id)
                ->get();
                unset($items);
                foreach ($details as $detail) {
                   
                    $id = $detail->id;
                    $foods_id = $detail->foods_id;
                    $qty = $detail->qty;
                    $price = $detail->price;
                    $orders_id = $detail->orders_id;
                    $foodname = $detail->name;
                    $fooddis = $detail->description;
                   $image = $detail->img;


                    $topins = DB::table('order_items_topins')
                    ->where(
                        [
                            'order_items_topins.order_id'=>  $orders_id,
                            'order_items_topins.id'=> $id
                        ]) 
                       
                    ->get();
                    
                                foreach ($topins as $topin) {
                                   
                                    $id = $topin->id;
                                    $pSize = $topin->pSize;
                               
                                    if($topin->pFcream!="0"||$topin->pFcream!=0.0){
                                         $pFcream=$topin->pFcream;
                                    }else{
                                        $pFcream="";
                                    }if($topin->pSkim!="0"||$topin->pSkim!=0.0){
                                         $pSkim=$topin->pSkim;
                                    }else{
                                        $pSkim="";
                                    
                                    }if($topin->pSoy!="0"||$topin->pSoy!=0.0){
                                         $pSoy=$topin->pSoy;
                                    }else{
                                        $pSoy="";
                                    
                                     }if($topin->pAlmond!="0"||$topin->pAlmond!=0.0){
                                         $pAlmond=$topin->pAlmond;
                                    }else{
                                        $pAlmond="";
                                    
                                    }if($topin->pOat!="0"||$topin->pOat!=0.0){
                                         $pOat=$topin->pOat;
                                    }else{
                                        $pOat="";
                                    }
                                    
                                    $top = $pFcream." ".$pSkim." ".$pSoy." ".$pAlmond." ".$pOat;
                                  
                                }
                

                    $items[]=collect(['id' => $id, 'foods_id' => $foods_id, 'qty' => $qty, 'price' => $price, 'orders_id' => $orders_id, 'image' => $image,'food_name'=>$foodname,'food_disc'=>$fooddis,'pSize'=>$pSize,'topins'=>$top]);

                }
                
            $data[] = collect(['id' => $id,'order_id' => $orderid, 'total' => $total, 'date' => $date,'payment_method'=>$payment_method,'status'=>$order_status, 'items' => $items]);
        }
        return json_encode($data);
    }
     public function orderBoxHistory($id)
      {
        $orders = DB::table('order_box')
            ->join('users', 'users.id', '=', 'order_box.users_id')
            ->select('order_box.*')
            ->where(
                [
                    'order_box.users_id' => $id,
                    // 'orders.status' => 1,
                ])
            ->orderBy('order_box.id', 'DESC')
            ->limit(10)
            ->get();

        $data = [];
        $items = [];

        foreach ($orders as $order) {
            unset($details);
            $id = $order->id;
            $orderid = $order->orderid;
            $total = $order->total;
            $user = $order->users_id;
            $payment_method = $order->payment_method;
            $date = $order->created_at;
             $order_status=$order->status;
             
            $details = DB::table('order_box_details')
                ->join('boxes', 'boxes.id', '=', 'order_box_details.bId')
                ->select('order_box_details.*', 'boxes.box_image', 'boxes.box_title')
                ->where('order_box_details.orders_box_id', $id)
                ->get();
            unset($items);
            foreach ($details as $detail) {

                $id = $detail->id;
                $box_id = $detail->bId;
                $qty = $detail->bQty;
                $price = $detail->bPrice;
                $orders_id = $detail->orders_box_id;
                $image = $detail->box_image;
                $boxname = $detail->box_title;

                $items[] = collect(['id' => $id, 'box_id' => $box_id, 'qty' => $qty, 'price' => $price, 'orders_id' => $orders_id, 'image' => $image,'box_name'=>$boxname]);

            }

            $data[] = collect(['id' => $id,'order_id' => $orderid, 'total' => $total, 'date' => $date, 'payment_method' => $payment_method,'status'=>$order_status, 'items' => $items]);
        }
        return json_encode($data);
    }
 
    public function getopendetails()
        {
        $today    = date('Y-m-d');
        $close = DB::table('closed_dates')->where('date', $today)->get()->first();
        
        $now = date('l');
        $today2 = (date("Y-m-d h:i:sa"));
        $open = DB::table('open_details')->where('day', $now)->get()->first();
        
        $closedate =  date ('Y-m-d h:i:sa',strtotime($open->close));
        $diff = date_create($closedate)->diff(date_create($today2));
        
        
        $closedate2 =  date ('Y-m-d h:i:sa',strtotime($open->open));
        $diff2 = date_create($closedate2)->diff(date_create($today2));
        
        
         $OpenDetails =  date ('Y-m-d H:i:sa',strtotime($open->open));
         $CloseDetails =  date ('Y-m-d H:i:sa',strtotime($open->close));
         $todayNew = (date("Y-m-d H:i:sa"));

                if ($todayNew > $OpenDetails && $todayNew < $CloseDetails) {
                   $defference =-1 ;
                }else{
                     $defference =1 ;
                }
            

        if($closedate2 > $today2) {
            $defference2 =-1 ;
        }
        else{
            $defference2 =($diff2->h * 3600 ) + ( $diff2->i * 60 ) + $diff2->s ;
        }
        
        // if($closedate < $today2) {
        //     $defference =-1 ;
        // }
        // else{
        //   $defference =($diff->h * 3600 ) + ( $diff->i * 60 ) + $diff->s ; 
        // }
        
        if($close){
            $closed=$close->full==1?0:1;
            $otime =  date ('h:i A',strtotime($close->open));
             $otimeDetails =  date ('Y-m-d H:i:sa',strtotime($close->open));
            $ctime =  date ('h:i A',strtotime($close->close));
             $ctimeDetails =  date ('Y-m-d H:i:sa',strtotime($close->close));
            $full = $close->full;
            $reason = $close->reason;
            // $defference = -1;
            
             if ($todayNew > $otimeDetails && $todayNew < $ctimeDetails) {
                   $defference =-1 ;
                }else{
                     $defference =1 ;
                }
                
  
        }
        else{
            $closed=$open->status;
            $otime = date ('h:i A',strtotime($open->open));
            $ctime = date ('h:i A',strtotime($open->close));
            $full = 0;
            $reason = null;
            // $defference = ($diff->h * 3600 )+( $diff->i * 60 ) +$diff->s ;
            // $defference =$closedate;
             $a="Outer";
        }
        
        $data = [
                'date' => $today,
                // 'closed' => $closed,
                'open' => $otime,
                'close' => $ctime,
                'full' => $full,
                'reason' => $reason,
                'status'=>$closed,
                'deff'=>$defference*1000,
                'now'=>$defference2*1000,
            ];
        
        
        
        return json_encode($data);
        }
        
        
        public function getweek(){
            $monday = strtotime("last sunday");
            
            $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
            $tuesday =strtotime(date("Y-m-d",$monday)." +1 days");
            $wednesday =strtotime(date("Y-m-d",$monday)." +2 days");
            $thursday =strtotime(date("Y-m-d",$monday)." +3 days");
            $friday =strtotime(date("Y-m-d",$monday)." +4 days");
            $saturday =strtotime(date("Y-m-d",$monday)." +5 days");
            $sunday = strtotime(date("Y-m-d",$monday)." +6 days");

            $open = DB::table('open_details')->get();
            $close = DB::table('closed_dates')->get();
            
        
        $week[0] = ['date'=>date("Y-m-d",$monday)];
        $week[1] = ['date'=>date("Y-m-d",$tuesday)];
        $week[2] = ['date'=>date("Y-m-d",$wednesday)];
        $week[3] = ['date'=>date("Y-m-d",$thursday)];
        $week[4] = ['date'=>date("Y-m-d",$friday)];
        $week[5] = ['date'=>date("Y-m-d",$saturday)];
        $week[6] = ['date'=>date("Y-m-d",$sunday)];
        
        $dates = DB::table('open_details')
            ->select('open','close')
            ->get();
        
        foreach( $dates as  $key => $d) {
            $open[$key]->open=date ('h:i A',strtotime($d->open));
            $open[$key]->close=date ('h:i A',strtotime($d->close));
        }
        
        foreach( $open as  $o) {
            foreach( $week as $w ){
                if(  $o->day == date('l',strtotime($w['date']))  ){
                    $open[$o->id-1]= [
                        "id" =>$o->id,
                        "day" =>$o->day,
                        "open" =>date ('h:i A',strtotime($o->open)),
                        "close" => date ('h:i A',strtotime($o->close)),
                        "status" =>$o->status,
                        "date"=>$w['date'],
                        "reason"=>'',
                        ];
                }
            }
        }
        
        foreach( $open as  $op) {
            foreach( $close as $second ){
                if(  $op['day'] == date('l',strtotime($second->date))  ){
                  $open[$op['id']-1]= [
                        "id" =>$op['id'],
                        "day" =>$op['day'],
                        "open" =>date ('h:i A',strtotime($second->open)),
                        "close" => date ('h:i A',strtotime($second->close)),
                        "status" =>$second->full==1?0:1,
                        "date"=>$op['date'],
                        "reason"=>$second->reason,
                      ];
                }
            }
            
        }
        
        
        
        
            return json_encode($open); 
          
        
        
        
        
        
        }
        
        public function getweek2(){
            $monday = strtotime("Today");
            
            $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
            $tuesday =strtotime(date("Y-m-d",$monday)." +1 days");
            $wednesday =strtotime(date("Y-m-d",$monday)." +2 days");
            $thursday =strtotime(date("Y-m-d",$monday)." +3 days");
            $friday =strtotime(date("Y-m-d",$monday)." +4 days");
            $saturday =strtotime(date("Y-m-d",$monday)." +5 days");
            $sunday = strtotime(date("Y-m-d",$monday)." +6 days");

            $open = DB::table('open_details')->get();
            $close = DB::table('closed_dates')->get();
            
        
        $week[0] = ['date'=>date("Y-m-d",$monday)];
        $week[1] = ['date'=>date("Y-m-d",$tuesday)];
        $week[2] = ['date'=>date("Y-m-d",$wednesday)];
        $week[3] = ['date'=>date("Y-m-d",$thursday)];
        $week[4] = ['date'=>date("Y-m-d",$friday)];
        $week[5] = ['date'=>date("Y-m-d",$saturday)];
        $week[6] = ['date'=>date("Y-m-d",$sunday)];
        
        $dates = DB::table('open_details')
            ->select('open','close')
            ->get();
        
        foreach( $dates as  $key => $d) {
            $open[$key]->open=date ('h:i A',strtotime($d->open));
            $open[$key]->close=date ('h:i A',strtotime($d->close));
        }
        
        foreach( $open as  $o) {
            foreach( $week as $w ){
                if(  $o->day == date('l',strtotime($w['date']))  ){
                    $open[$o->id-1]= [
                        "id" =>$o->id,
                        "day" =>$o->day,
                        "open" =>date ('h:i A',strtotime($o->open)),
                        "close" => date ('h:i A',strtotime($o->close)),
                        "status" =>$o->status,
                        "date"=>$w['date'],
                        "reason"=>'',
                        ];
                }
            }
        }
        
        foreach( $open as  $op) {
            foreach( $close as $second ){
                if(  $op['day'] == date('l',strtotime($second->date))  ){
                  $open[$op['id']-1]= [
                        "id" =>$op['id'],
                        "day" =>$op['day'],
                        "open" =>date ('h:i A',strtotime($second->open)),
                        "close" => date ('h:i A',strtotime($second->close)),
                        "status" =>$second->full==1?0:1,
                        "date"=>$op['date'],
                        "reason"=>$second->reason,
                      ];
                }
            }
            
        }
        
        
        
        
            return json_encode($open); 
          
        
        
        
        
        
        }

}
