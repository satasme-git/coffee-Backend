<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    protected function newOrder(Request $req)
    {
// status 0=order cancelled
// status 1=new order
// status 2=payment completed
// status 3=free coffee

		$userid =$req->get('user_id');
		$getfoods=$req->input('foods');
		$total=0;
		// $time=time();
		$datenow=Carbon::now()->toDateTimeString();
		$datesub = explode(' ', trim($datenow))[0];
		$timesub = explode(' ', trim($datenow))[1];
		$time=str_replace(':', '', $timesub);
		$datefull=str_replace('-', '', $datesub);
		$date=substr($datefull, 2, 8);
		$orderid="".$time.$date;
		foreach ($getfoods as $foods=>$key) {
			$prid=$key['product_id'];
			$priceget= DB::table('foods')
        		->where('id', $prid)
				->first();
			$price=$priceget->price;
			$qty=$key['qty'];
			$total+=($price*$qty);
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
		
		foreach ($getfoods as $foods=>$key) {
			$prid=$key['product_id'];
			$priceget= DB::table('foods')
        		->where('id', $prid)
				->first();
			$price=$priceget->price;
			$qty=$key['qty'];
			$fooddata = [
			 'foods_id' => $prid,
			 'qty' => $qty,
			 'price' => $price,
			 'orders_id' => $ordersid,
			];
			$orderfoodid =DB::table('order_foods')->insertGetId($fooddata);
		}
	   if(empty($orderfoodid)){
		   $resp="failed to execute";
	   }else{
		   $resp="success";
	   }

	   return json_encode($resp);
	}

	protected function testOrder(Request $req)
    {
	   return json_encode($req);
	}

	

}