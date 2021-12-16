<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Foods;
use App\Models\Orders;
use Cart;
use Carbon\Carbon;
use Session;
use Redirect;
use Validator;
use Illuminate\Support\Facades\Hash;

class POSController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {

        $details = DB::table( 'foods' )
        ->Join( 'subcategory', 'foods.subcategory_id', '=', 'subcategory.id' )
        ->leftJoin( 'coffee_add_extra_new', 'foods.id', '=', 'coffee_add_extra_new.food_id' )
        ->leftJoin( 'sizes2', 'foods.id', '=', 'sizes2.food_id' )
        ->select( 'foods.*', 'coffee_add_extra_new.full_cream', 'coffee_add_extra_new.skim', 'coffee_add_extra_new.soy', 'coffee_add_extra_new.almond', 'coffee_add_extra_new.oat', 'sizes2.small', 'sizes2.medium', 'sizes2.large' )
        ->where([
            // ['status', '=', 1],
            ['foods.subcategory_id', '!=', 9]
        ])
        ->get();

        $data  = DB::table( 'foods' )
        ->Join( 'subcategory', 'foods.subcategory_id', '=', 'subcategory.id' )
        ->leftJoin( 'coffee_add_extra_new', 'foods.id', '=', 'coffee_add_extra_new.food_id' )
        ->leftJoin( 'sizes2', 'foods.id', '=', 'sizes2.food_id' )
        ->select( 'foods.*', 'subcategory.name AS subcat_name', 'coffee_add_extra_new.full_cream', 'coffee_add_extra_new.skim', 'coffee_add_extra_new.soy', 'coffee_add_extra_new.almond', 'coffee_add_extra_new.oat', 'sizes2.small', 'sizes2.medium', 'sizes2.large' )
        ->get();

        $orders  = DB::table( 'orders' )
        ->Join( 'users', 'orders.users_id', '=', 'users.id' )
        ->select( 'orders.*', 'users.name as user_name', 'users.email' )
        ->where( 'orders.status', 10 )
        ->get();

        $users  = DB::table( 'users' )
        ->select( 'users.name', 'users.id')
        ->where( 'users.status', 0 )
        ->get();
        // $count = Orders::where( 'status', '=', '10' )->count();

        return view( 'admin/POS/PountOfSaleDashboard', compact( 'details', 'data', 'orders' ,'users') );

    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $id ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        //
    }

    public function getAllFoods() {
        $details = DB::table( 'foods' )
        ->Join( 'coffee_add_extra_new', 'foods.id', '=', 'coffee_add_extra_new.food_id' )
        ->Join( 'sizes2', 'foods.id', '=', 'sizes2.food_id' )
        ->select( 'foods.*', 'coffee_add_extra_new.full_cream', 'coffee_add_extra_new.skim', 'coffee_add_extra_new.soy', 'coffee_add_extra_new.almond', 'coffee_add_extra_new.oat', 'sizes2.small', 'sizes2.medium', 'sizes2.large' )
        ->get();
        return view( 'admin/POS/PountOfSaleDashboard', compact( 'details' ) );

    }

    public function addToCart( Request $request ) {
        $food = Foods::find( $request->id );
        // Require Fields
        $product_id  = $food->id;
        // Required
        $product_name = $food->name;
        // Required
        $product_qty = $request->qty;
        // Required
        $product_price = $request->total;
        // Required

        if ( $request->size == null ) {
            $product_size = '';
        } else {
            $product_size = $request->size;

        }
        $cars = $request->ele;

        $product_info = [];
        if ( $cars != null ) {
            for ( $i = 0; $i<count( $cars );
            $i++ ) {
                $product_info[ $cars[ $i ] ] = 'true';
            }
        } else {
            $product_info = [];

        }

        //     // 2nd example
        $newCart = Cart::add( $product_id, $product_name, $product_size, $product_qty, $product_price, $product_weight = 1, $product_thumb = null, $discount = 0, $shipping_charge = 0, $tax = 0, $product_info );
        // // // return  $request->id;
        $items = Cart::items();
        return json_encode( $items );
    }

    public function cart() {
        $items = Cart::items();
        // return $items;
        // return Cart::total();
        return json_encode( $items );
    }

    public function removeToCart( $uid ) {
        Cart::remove( $uid );
        // Cart::clear();

        return json_encode( Cart::total() );
    }

    public function cancelToCart() {

        Session::forget( 'hold_invoice_number' );
        Session::forget( 'customer_name' );
        Session::forget( 'customer_id' );
        
        $count = Cart::count();

        if ( $count>0 ) {
            Cart::clear();
            return json_encode( Cart::total() );
        } else {
            return json_encode( -1 );
        }

    }

    public function loadcart() {
        $items = Cart::items();

        //    return   $items;
        return json_encode( $items );
    }

    public function getOrder() {
        $items = Cart::info();

        //    return   $items;
        return json_encode( $items );
    }

    public function getDatabyId( $id ) {
        $data  = DB::table( 'foods' )
        ->Join( 'coffee_add_extra_new', 'foods.id', '=', 'coffee_add_extra_new.food_id' )
        ->Join( 'sizes2', 'foods.id', '=', 'sizes2.food_id' )
        ->select( 'foods.*', 'coffee_add_extra_new.full_cream', 'coffee_add_extra_new.skim', 'coffee_add_extra_new.soy', 'coffee_add_extra_new.almond', 'coffee_add_extra_new.oat', 'sizes2.small', 'sizes2.medium', 'sizes2.large' )
        ->where( 'foods.id', $id )
        ->get();

        return response()->json( $data, 200 );
    }

    public function checkout( Request $request ) {
        $name=$request->user_id;

		$validationdata = array('customer_name'=>$name);
		$validationtype = array('customer_name' => 'required');
		
		$validator  = Validator::make($validationdata, $validationtype);;
		
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput();
		}else{

        $count =  Cart::count();
        if ( $request->payment_method == 'Card payment' ) {
            $payment_method = 'Card';
        } else if ( $request->payment_method == 'Cash payment' ) {
            $payment_method = 'Cash';
        }
        if ( Session::get( 'hold_invoice_number' ) != '' ) {

            $id = Session::get( 'hold_invoice_number' );
            $data[ 'status' ] = 1;
            $data[ 'payment_method' ] = $payment_method;
            
            DB::table( 'orders' )->where( 'id', $id )->update( $data );
            $request->session()->flash( 'msg', 'holdinsert' );
            Cart::clear();
            Session::forget( 'hold_invoice_number' );
            Session::forget( 'customer_name' );
            Session::forget( 'customer_id' );
            return redirect()->back();
        } else {

            if ( $count>0 ) {
                
                $cart = new Cart();
                $data = $this->loadcart();

                date_default_timezone_set( 'Asia/Colombo' );
                $dataOrder = [
                    'orderid' => date( 'ymdhis' ),
                    'total' => Cart::total(),
                    'status'=>1,
                    'users_id'=> $request->user_id,
                    'payment_method'=>$payment_method,
                    'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),

                ];

                $id = DB::table( 'orders' )->insertGetId( $dataOrder );
                $cartItems = json_decode( $data, true );
                $k = 1;
                foreach ( $cartItems[ 'original' ] as $i => $v ) {
                    $fullcream = '0';
                    $skim = '0';
                    $soy = '0';
                    $almond = '0';
                    $oat = '0';

                    $uid = $v[ 'uid' ];
                    $size = $v[ 'size' ];
                    $amount=$v[ 'qty' ]*$v[ 'price' ];
                    // // echo $uid.'</br>';
                    $cartItems = array(
                        'foods_id'  	=> $v[ 'product' ],
                        'qty' 	=>   $v[ 'qty' ],
                        'price'   =>  $amount,
                        'orders_id'   => $id
                    );

                    $orderfood_id = DB::table( 'order_foods' )->insertGetId( $cartItems );

                    foreach ( $v[ 'options' ] as $key => $value ) {

                        if ( $key == 'icecream' ) {
                            $fullcream = $key;
                        } else if ( $key == 'skim' ) {
                            $skim = $key;
                        } else if ( $key == 'soy' ) {
                            $soy = $key;
                        } else if ( $key == 'almond' ) {
                            $almond = $key;
                        } else if ( $key == 'oat' ) {
                            $oat = $key;
                        }

                    }
                    $cartTopins = array(
                        'tId'  	=>  $k,
                        'pId' 	=>  $v[ 'product' ],
                        'pSize'   => $size,
                        'pFcream'   =>$fullcream,
                        'pSkim'   =>  $skim,
                        'pSoy'   => $soy,
                        'pAlmond'   => $almond,
                        'pOat'   => $oat,
                        'order_id'   => $id,
                        'order_foods_id'   =>$orderfood_id

                    );

                    DB::table( 'order_items_topins' )->insertGetId( $cartTopins );
                    $k++;
                }
                $request->session()->flash( 'msg', 'insert' );

                Cart::clear();

                $details = DB::table( 'foods' )
                ->leftJoin( 'coffee_add_extra_new', 'foods.id', '=', 'coffee_add_extra_new.food_id' )
                ->leftJoin( 'sizes2', 'foods.id', '=', 'sizes2.food_id' )
                ->select( 'foods.*', 'coffee_add_extra_new.full_cream', 'coffee_add_extra_new.skim', 'coffee_add_extra_new.soy', 'coffee_add_extra_new.almond', 'coffee_add_extra_new.oat', 'sizes2.small', 'sizes2.medium', 'sizes2.large' )
                ->get();

            } else {
                $request->session()->flash( 'msg', 'cartzero' );
            }
            return redirect()->back();

        }
    }
    }

    public function loadcartProduct() {

        $data = DB::table( 'foods' )->get();
        return response()->json( $data, 200 );
    }

    public function hold($uid ) {

        $cart = new Cart();
        $data = $this->loadcart();

        date_default_timezone_set( 'Asia/Colombo' );
        $dataOrder = [
            'orderid' => date( 'ymdhis' ),
            'total' => Cart::total(),
            'status'=>10,
            'users_id'=>$uid ,
            'payment_method'=>'Hold',
            'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
            'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),

        ];

        $id = DB::table( 'orders' )->insertGetId( $dataOrder );
        $cartItems = json_decode( $data, true );
        $k = 1;
        foreach ( $cartItems[ 'original' ] as $i => $v ) {
            $fullcream = '0';
            $skim = '0';
            $soy = '0';
            $almond = '0';
            $oat = '0';

            $uid = $v[ 'uid' ];
            $size = $v[ 'size' ];
            // // echo $uid.'</br>';
            $cartItems = array(
                'foods_id'  	=> $v[ 'product' ],
                'qty' 	=>   $v[ 'qty' ],
                'price'   => $v[ 'price' ],
                'orders_id'   => $id
            );

            $orderfood_id = DB::table( 'order_foods' )->insertGetId( $cartItems );

            foreach ( $v[ 'options' ] as $key => $value ) {

                if ( $key == 'icecream' ) {
                    $fullcream = $key;
                } else if ( $key == 'skim' ) {
                    $skim = $key;
                } else if ( $key == 'soy' ) {
                    $soy = $key;
                } else if ( $key == 'almond' ) {
                    $almond = $key;
                } else if ( $key == 'oat' ) {
                    $oat = $key;
                }

            }
            $cartTopins = array(
                'tId'  	=>  $k,
                'pId' 	=>  $v[ 'product' ],
                'pSize'   => $size,
                'pFcream'   =>$fullcream,
                'pSkim'   =>  $skim,
                'pSoy'   => $soy,
                'pAlmond'   => $almond,
                'pOat'   => $oat,
                'order_id'   => $id,
                'order_foods_id'   =>$orderfood_id

            );

            DB::table( 'order_items_topins' )->insertGetId( $cartTopins );
            $k++;
        }
        // $request->session()->flash( 'msg', 'insert' );

        Cart::clear();

        $details = DB::table( 'foods' )
        ->leftJoin( 'coffee_add_extra_new', 'foods.id', '=', 'coffee_add_extra_new.food_id' )
        ->leftJoin( 'sizes2', 'foods.id', '=', 'sizes2.food_id' )
        ->select( 'foods.*', 'coffee_add_extra_new.full_cream', 'coffee_add_extra_new.skim', 'coffee_add_extra_new.soy', 'coffee_add_extra_new.almond', 'coffee_add_extra_new.oat', 'sizes2.small', 'sizes2.medium', 'sizes2.large' )
        ->get();

        Cart::clear();

        return json_encode( Cart::total() );

    }

    public function addtocart_holdInvoice( $id ) {
        Cart::clear();

        $users  = DB::table( 'orders' )
        ->Join( 'users', 'orders.users_id', '=', 'users.id' )
        ->select( 'orders.*', 'users.id as user_id', 'users.name')
        ->where( 'orders.id', $id )
        ->get();
        
        $orders  = DB::table( 'order_foods' )
        ->Join( 'foods', 'order_foods.foods_id', '=', 'foods.id' )
        ->leftJoin( 'order_items_topins', 'order_foods.id', '=', 'order_items_topins.order_foods_id' )
        ->select( 'order_foods.*', 'foods.name', 'order_items_topins.pSize', 'order_items_topins.pFcream', 'order_items_topins.pSkim', 'order_items_topins.pSoy', 'order_items_topins.pAlmond', 'order_items_topins.pOat' )
        ->where( 'order_foods.orders_id', $id )
        ->get();


        $product_info = [];
        $order_id;
        foreach ( $orders as $order ) {
            $order_id = $order->orders_id;
            $product_id  = $order->id;
            // Required
            $product_name = $order->name;
            // Required
            $product_qty = $order->qty;
            // Required
            $product_price =  $order->price;
            // Required
            $product_size = $order->pSize;
            // if ()

            if ( $order->pFcream == 'icecream' ) {
                $product_info[ 'fullcream' ] = 'true';
            }
            if ( $order->pSkim == 'skim' ) {
                $product_info[ 'skim' ] = 'true';
            }
            if ( $order->pSoy == 'soy' ) {
                $product_info[ 'soy' ] = 'true';
            }
            if ( $order->pAlmond == 'almond' ) {
                $product_info[ 'almond' ] = 'true';
            }
            if ( $order->pOat == 'oat' ) {
                $product_info[ 'oat' ] = 'true';
            }
            Cart::add( $product_id, $product_name, $product_size, $product_qty, $product_price, $product_weight = 1, $product_thumb = null, $discount = 0, $shipping_charge = 0, $tax = 0, $product_info );
        }

        Session::put( 'hold_invoice_number', $order_id );
        foreach ( $users as $user ) {
            Session::put( 'customer_name', $user->name );
            Session::put( 'customer_id', $user->user_id );
        }
        // Session::put( 'customer_name', $order_id );
        return redirect()->back();
    }

    public function holdinvoiceupdate( Request $request ) {

        // $id = Session::get( 'hold_invoice_number' );
        // $data[ 'status' ] = 1;
        // DB::table( 'orders' )->where( 'id', $id )->update( $data );
        // $request->session()->flash( 'msg', 'insert' );
        // Cart::clear();
        // Session::forget( 'hold_invoice_number' );
        // return redirect()->back();

        

    }

    public function count() {
        $id = Session::get( 'hold_invoice_number' );
        if ( $id != '' ) {
            return json_encode( 'error' );
        } else {
            return json_encode( Cart::count() );
        }

    }
    public function add_customers(Request $request){
      
    }
    public function form_submit(Request $request){
        // $name =$request->get('name');
        // $email =$request->get('email');

        $name =$request->get('name');
        $email =$request->get('email');
        $mobile_no =$request->get('mobile_no');
		$status =1;
		
		// $id =$request->get('id');
        // $user = $req->file('user');

		// $validationdata = array('name'=>$name,'email'=>$email,'mobile_no'=>$mobile_no);
		// $validationtype = array('email' => 'required','mobile_no' => 'required','name' => 'required');
		
        // $validator=
		$validator  = Validator::make( $request->all(),[
            'email' => 'required',
            'mobile_no' => 'required',
            'name' => 'required'
        ]);
		
		if(!$validator->passes()){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
			// return redirect()->back()->withErrors($validator)->withInput();
		}else{
            // echo "asdasdas";
            $data = [
			         
                'name' => $name,
                'email' => $email,
                'mobile_no' => $mobile_no,
                 'status' => $status,
                 'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                 'password' => Hash::make(123),
                ];
                $id = DB::table('users')->insertGetId($data);
				 
				// $req->session()->flash('msg', '<div class="alert alert-success">Record Added <a class="close" data-dismiss="alert">×</a> </div>');
            return response()->json(['status'=>1,'msg'=>'success ddd']);
        }


        // return response()->json( "sdsdsdsdsds >>>>>>>>>>>>>> ".$request->name);

    }
    public function get_food_all(){
        $details = DB::table( 'foods' )
        ->Join( 'subcategory', 'foods.subcategory_id', '=', 'subcategory.id' )
        ->leftJoin( 'coffee_add_extra_new', 'foods.id', '=', 'coffee_add_extra_new.food_id' )
        ->leftJoin( 'sizes2', 'foods.id', '=', 'sizes2.food_id' )
        ->select( 'foods.*', 'coffee_add_extra_new.full_cream', 'coffee_add_extra_new.skim', 'coffee_add_extra_new.soy', 'coffee_add_extra_new.almond', 'coffee_add_extra_new.oat', 'sizes2.small', 'sizes2.medium', 'sizes2.large' )
        ->where([
            // ['status', '=', 1],
            ['foods.subcategory_id', '!=', 9]
        ])
        ->get();
        return response()->json( $details, 200 );
    }
    public function get_box_all(){
        $details = DB::table( 'foods' )
        ->Join( 'subcategory', 'foods.subcategory_id', '=', 'subcategory.id' )
        ->leftJoin( 'coffee_add_extra_new', 'foods.id', '=', 'coffee_add_extra_new.food_id' )
        ->leftJoin( 'sizes2', 'foods.id', '=', 'sizes2.food_id' )
        ->select( 'foods.*', 'coffee_add_extra_new.full_cream', 'coffee_add_extra_new.skim', 'coffee_add_extra_new.soy', 'coffee_add_extra_new.almond', 'coffee_add_extra_new.oat', 'sizes2.small', 'sizes2.medium', 'sizes2.large' )
        ->where('foods.subcategory_id', 9)
        ->get();

        return response()->json( $details, 200 );
    }
    public function testing(){
        echo   $details = DB::table( 'foods' )
        ->Join( 'subcategory', 'foods.subcategory_id', '=', 'subcategory.id' )
        ->leftJoin( 'coffee_add_extra_new', 'foods.id', '=', 'coffee_add_extra_new.food_id' )
        ->leftJoin( 'sizes2', 'foods.id', '=', 'sizes2.food_id' )
        ->select( 'foods.*', 'coffee_add_extra_new.full_cream', 'coffee_add_extra_new.skim', 'coffee_add_extra_new.soy', 'coffee_add_extra_new.almond', 'coffee_add_extra_new.oat', 'sizes2.small', 'sizes2.medium', 'sizes2.large' )
        ->where('foods.subcategory_id', 9)
        ->get();

    }
        
    
}
