<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Orders;
use App\Models\OrderFoods;
use App\Models\Users;

class OrderControllerAdmin extends Controller
{
    
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
	// 		if($orders->orderid ==$orderid){
	// 			$data['orders'][$orderid].push($orders);
	// 		}else{
	// 			$count++;
	// 			$data['orders']=['orderid'=>$orders->orderid,$orders];
	// 		}
	// 		$qty=$orders->itemqty;
	//    }
	//    dd($count);

		// $data['orders']=OrderFoods::get()->first();


		// $data['orders']=Orders::join ('orders', 'user.schedule_id', '=', 'schedules.id')
    	// 	->select ('users.id')
    	// 	->orderBy ('schedules.date')
		// 	->get ()->toArray ();
		
		// $data['orders']=Orders::with (['orderfoods'])->get()->all();
		$data['orders']=Orders::get()->all();

	//    dd($data);
	   return view('admin/orders',$data);
	}
	
	protected function viewFoods($id,Request $req )
    {
		$data['orders']=Orders::with (['orderfoods'])->where('id', $id)->get()->all();

	 	// dd($data);
	   return view('admin/viewFood',$data);
	}

	protected function purchaseOrder($id,Request $req )
    {
		// dd("ok");
		$dat['orders']=Orders::with (['orderfoods'])->where('id', $id)->get()->all();
		$qty=0;
	   foreach($dat['orders'] as $orders){
		$userid=$orders->users_id;
		foreach($orders->orderfoods as $orderfoods){
			$qty+=$orderfoods->qty;
		}
	   }
	   		$check= DB::table('order_points')
            ->where('users_id', $userid)
            ->where('status', 'Active')
            ->select(DB::raw('sum(points) as points'))
			->get();
			$orderid=$id;
			$pointid=1;
			// dd(response()->json($check));
			$encode=json_encode($check);
			$crrpoints=0;
			foreach($check as $point){
				$crrpoints+=$point->points;
			}
			if($pointid==1 && $crrpoints>250){
				return redirect()->back()->with('alert', 'Deleted!');
			}else{
	   			$totalpoints=50*$qty;
	   			$data= ['orders_id' => $orderid,'users_id' => $userid,'point_id' => $pointid,'points' => $totalpoints,'created_at' => \Carbon\Carbon::now()->toDateTimeString(),'status' => 'Active'];
	   			$pid=DB::table('order_points')->insertGetId($data);
	   			if(empty($pid)){
					return redirect()->to('/admin/orders')->with('msg', '<div class="alert alert-danger">Error while executing.<a class="close" data-dismiss="alert">x</a></div>');
				}else{
					$updateorder=['status' => '2'];
					DB::table('orders')->where(['id' => $orderid])->update($updateorder);
					return redirect()->to('/admin/orders')->with('msg', '<div class="alert alert-success">Successfully purchased.<a class="close" data-dismiss="alert">x</a></div>');
				}
			}
	//    dd($pid);
	   
	}

	protected function denyFreeCofee($id,Request $req )
    {
		$dat['orders']=Orders::with (['orderfoods'])->where('id', $id)->get()->all();
		$qty=0;
	   foreach($dat['orders'] as $orders){
		   
		$userid=$orders->users_id;
		foreach($orders->orderfoods as $orderfoods){
			$qty+=$orderfoods->qty;
		}
	   }
	   $orderid=$id;
	   $pointid=1;
	   $totalpoints=50*$qty;
	   $data= ['orders_id' => $orderid,'users_id' => $userid,'point_id' => $pointid,'points' => $totalpoints,'created_at' => \Carbon\Carbon::now()->toDateTimeString(),'status' => 'Active'];
	   $pid=DB::table('order_points')->insertGetId($data);
	   if(empty($pid)){
			return redirect()->to('/admin/orders')->with('msg', '<div class="alert alert-danger">Error while executing.<a class="close" data-dismiss="alert">x</a></div>');
	   }else{
			$updateorder=['status' => '2'];
			DB::table('orders')->where(['id' => $orderid])->update($updateorder);
			return redirect()->to('/admin/orders')->with('msg', '<div class="alert alert-success">Successfully purchased.<a class="close" data-dismiss="alert">x</a></div>');
	   }
	}

	protected function AcceptFreeCofee($id,Request $req )
    {
		$dat['orders']=Orders::with (['orderfoods'])->where('id', $id)->get()->all();
		$qty=0;
	   foreach($dat['orders'] as $orders){
		$userid=$orders->users_id;
		foreach($orders->orderfoods as $orderfoods){
			$qty+=$orderfoods->qty;
		}
	   }
	   $orderid=$id;
	   $pointid=1; 
	   $totalpoints=50*($qty-1);
	   $data= ['orders_id' => $orderid,'users_id' => $userid,'point_id' => $pointid,'points' => $totalpoints,'created_at' => \Carbon\Carbon::now()->toDateTimeString(),'status' => 'Active'];
	   $pid=DB::table('order_points')->insertGetId($data);
	   if(empty($pid)){
			return redirect()->to('/admin/orders')->with('msg', '<div class="alert alert-danger">Error while executing.<a class="close" data-dismiss="alert">x</a></div>');
	   }else{
			$updateorder=['status' => '3'];
			DB::table('orders')->where(['id' => $orderid])->update($updateorder);
			
			$check= DB::table('order_points')
            ->where('users_id', $userid)
            ->where('status', 'Active')
			->get();

			$deductpoints=0;
			$round1=true;
			foreach($check as $point){
				$deductpoints+=$point->points;
				if($round1){
					$updatepoints=['status' => 'Used'];
					DB::table('order_points')->where(['id' => $point->id])->update($updatepoints);
					$round1=false;
				}else{
					if($deductpoints<=250){
						$updatepoints=['status' => 'Used'];
						DB::table('order_points')->where(['id' => $point->id])->update($updatepoints);
					}
				}
				
			}

			return redirect()->to('/admin/orders')->with('msg', '<div class="alert alert-success">Successfully purchased.<a class="close" data-dismiss="alert">x</a></div>');
	   }
	}

}