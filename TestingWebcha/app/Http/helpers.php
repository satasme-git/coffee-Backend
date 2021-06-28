<?php

use App\Common;
use App\Cart;
use App\Mats;
use Illuminate\Support\Facades\DB;

function money_formate($number) {
    return env('CURRENCY_SYMBOL', '$') . number_format(round($number, 1), 2, ".", ",");
}

function round_price($number) {
    return number_format(round($number, 1), 2, ".", ",");
}

function datetime_formate($date, $time = true) {
    $date = new DateTime($date);
    if ($time) {
        return $date->format('m/d/Y H:i:s');
    }
    return $date->format('m/d/Y');
}

function is_serial($string) {
    return (@unserialize($string) !== false || $string == 'b:0;');
}

function get_price($var1, $var2, $size, $price) {
    $var3 = $var1 / $var2;
    if ($var2 > $var1) {
        $var3 = $var2 / $var1;
    }
    $size2 = $size / $var3;
    return number_format(($size + $size2) * 2.54 * $price, 2, '.', '');
}

function getcartdata() {
    $common = new common();
    return $common->get_cart();
}

function pixel_to_cm($pixel) {
    $pixel = (int) $pixel;
    if ($pixel > 0) {
        //px to cm ;
        //return round(($pixel*2.54/150));
        //px to mm ;
        return round(($pixel * 2.54 / 15));
    } else {
        return 0;
    }
}

function cart_count() {
    $user = session('user');
    $session_id = session()->getId();
    if (!empty($user)) {
        return Cart::where('user_id', '=', $user->id)->count();
    } else {
        return Cart::where('session_id', '=', $session_id)->count();
    }
}

function is_admin() {
    return session('adminuser');
}

/* function getservice($id = 0){
  $services=[
  1=>"Digital Photo & Poster Print",
  2=>"Photo On Canvas",
  3=>"Photo To Art",
  4=>"Photo Collage",
  6=>"Frames and Framming",
  7=>"Block Mount",
  8=>"Acrylic Desktop Block",
  9=>"Acrylic Permanent Block",
  10=>"Acrylic Photo Block",
  11=>"Acrylic Sandwich Block",
  12=>"Shadow Box Frame",
  13=>"Box Frame",
  14=>"Box Frame With Rebate",
  15=>"Clip Frame",
  16=>"Budget Frames",
  17=>"Mirror Frames",
  18=>"Matts Single",
  19=>"Matts Multi",
  20=>"Matts Cerificate",
  21=>"Matts Signature",
  22=>"Aluminium Frames",

  ];
  if(!empty($id)){
  if(isset($services[$id])){
  return $services[$id];
  }else{
  return false;
  }
  }else{
  return $services;
  }
  } */

function getservice($id = 0) {
    $services = DB::table('services')->select('id', 'service')->get();
    $ids = $services->pluck('id')->all();
    $service = $services->pluck('service')->all();
    $services = array_combine($ids, $service);
    if (!empty($id)) {
        if (isset($services[$id])) {
            return $services[$id];
        } else {
            return false;
        }
    } else {
        return $services;
    }
}

function getuploadoption($id = 0) {
    $uploadoptions = [1 => "Upload Image", 2 => 'Email Image', 3 => 'Post Image'];
    if ($id == 0) {
        return $uploadoptions;
    } else {
        if (isset($uploadoptions[$id])) {
            return $uploadoptions[$id];
        } else {
            return false;
        }
    }
}

function get_data($table, $field, $id) {
    $record = Mats::where($field, $id)->first();
    return $record;
}

function get_option_table_array() {
    return ['effect', 'papertype', 'timbersize', 'edge_type', 'finishtype', 'hanging_system', 'backing_color', 'border', 'rebate', 'hanging_method'];
}

function get_display_title($option) {
    $titles = ['size' => 'Size', 'effect' => 'Effect', 'papertype' => 'Paper Type', 'timbersize' => 'Timber Size', 'edge_type' => 'Edge Type', 'finishtype' => 'Laminate Type', 'hanging_system' => 'Hanging System', 'backing_color' => 'Backing Color', 'border' => 'Border', 'backing' => 'Baking', 'glass' => 'Glass', 'rebate' => 'Rebate', 'medium' => 'Medium', 'hanging_method' => 'Hanging Method'];
    return isset($titles[$option]) ? $titles[$option] : false;
}

function mirror_price($price, $width, $height) {
    if (!empty($width) && !empty($height)) {
        return (($width + $height) / 10) * $price;
    } else {
        return false;
    }
}

function get_matproduct_service($service = 0) {

    $services = [18,19, 20, 21];
    return $service == 0 ? $services : in_array($service, $services);
}

function frame_price_wrapper($frame, $size_width, $size_height, $service = null, $size = null, $custom_size = null) {
    $frame_price = 0;
    if (isset($custom_size)) {
        $frame_price = frame_price($frame->running_price, $size_width, $size_height);
    } elseif (isset($size)) {
        if (isset($service) && $service->id == 16) {
            $frame_price = $size->price;
        } else {
            $frame_price = frame_price($frame->running_price, $size_width, $size_height);
        }
    }
    // var_dump($frame);
    $num = frame_price($frame->running_price, $size_width, $size_height);
    return number_format(round($num, 1), 2);
}

function frame_price($price, $width, $height) {
    if (!empty($width) && !empty($height)) {
        return (($width + $height) / 10) * $price;
    } else {
        return false;
    }
}

function option_price($price, $width, $height) {
    if (!empty($width) && !empty($height)) {
        return (($width + $height) / 10) * $price;
    } else {
        return false;
    }
}

// function mat_price($width,$height,$service=0,$mat_type=0){
// /*Mat Price is the same for all Mats ($0.13) and is calculated off final size 
// selected for Mat, dimensions become 16+21 for example 1, or 26+21 for example 2.
// */
// if(!empty($width) && !empty($height)){
// $price = 0.13;
// if($service == 12){
// $price = 0.10;
// if($mat_type==2){
// $price=0.6;
// }
// }
// if( $service ==13){
// $price=0.25;
// if($mat_type==2){
// $price=0.7;
// }
// }
// return (($width+$height)/10) * $price;
// }else{
// return false;
// }
// }

function mat_price($width, $height, $price) {
    if (!empty($width) && !empty($height)) {

        return (($width + $height) / 10) * $price;
    } else {
        return false;
    }
}

function neglate_size_price($service) {
    $services = [6, 12, 13, 14, 16, 18, 19, 20, 21, 22];
    return in_array($service, $services);
}

function add_size_price($service) {
    $services = [16];
    return in_array($service, $services);
}
function get_block_mount_price($type, $width, $height) {
$a = [];

$a["title"] = "";

$a["price"] = "";

if ($type === "basic") {
	$rlp = 0.5;
	$title = "5mm Block Mount";
} else if ($type === "premium") {
	$rlp = 0.7;
	$title = "10mm Block Mount";
} else if ($type === "deluxe") {
	$title = "20mm Block Mount";
	$rlp = 1.2;
}

$a["price"] = (($width + $height) * $rlp)/10;

$a["title"] = $title;

return $a;
}
function uploadImagePrice($width, $height) {
    /* asume linear CM price of uploaded image is 0.13 not axect */
    return (($width + $height) / 10) * 0.13;
}

function clipframePrice($width, $height) {
    /* asume linear CM price of uploaded image is 0.13 not axect */
    return (($width + $height) / 10) * 0.45;
}

function getrandstring($length = 10) {
    $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $res = "";
    for ($i = 0; $i < $length; $i++) {
        $res .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    $code = DB::table('gift_card')->where('code', $res)->first();
    if (!empty($code)) {
        getrandstring();
    }
    return $res;
}

function maton($id) {
    $maton = [1 => 'Top Mat', 2 => 'Middle Mat', 3 => 'Bottom Mat'];
    return isset($maton[$id]) ? $maton[$id] : '';
}

function product_price($price, $width, $height, $product_id, $fixedprice = false) {
    $parent_id = DB::select("SELECT * FROM styles JOIN product ON product.style=styles.id WHERE product.id=?", [$product_id])[0]->parent;
    if($parent_id == 3) // Check if parent = 3 (Poster Print product)...
    {
        return DB::select("SELECT price FROM size WHERE product=?", [$product_id])[0]->price;
    }
    $price = false;
    if (!empty($product_id)) {
        $product = DB::table('product')
                        ->select('product.*', 'styles.parent')
                        ->join('styles', 'product.style', '=', 'styles.id')->where('product.id', '=', $product_id)->get()->first();
        if ($product->parent == 2 && $product->manufacturer != '') {
            $manufacturer = DB::table('manufacturer')->where('id', $product->manufacturer)->first();
            $price = option_price($manufacturer->price, $width, $height);
        } elseif ($product->parent == 1) {
            $price = $fixedprice;
        }
    }
    return $price;
}

function medium_price($price, $width, $height, $product_id) {
    $price = option_price($price, $width, $height);
    if (!empty($product_id)) {
        $product = DB::table('product')
                        ->select('product.*', 'styles.parent')
                        ->join('styles', 'product.style', '=', 'styles.id')->where('product.id', '=', $product_id)->get()->first();
        if ($product->parent == 1) {
            $price = false;
        }
        if($product->parent == 3) // poster print product
        {
            $price = false;
        }
    }
    return $price;
}

function fillpatternonimage($patternImage, &$destImage, $width, $height) {
    $image = imagecreatefromjpeg($patternImage);
    $imageWidth = imagesx($image);
    $imageHeight = imagesy($image);
    $newImage = $destImage;
    $newImage = imagecreatetruecolor($width, $height);

    //filling the Pattern image
    for ($imageX = 0; $imageX < $width; $imageX += $imageWidth) {
        for ($imageY = 0; $imageY < $height; $imageY += $imageHeight) {
            imagecopy($newImage, $image, $imageX, $imageY, 0, 0, $imageWidth, $imageHeight);
        }
    }
    $destImage = $newImage;
    imagedestroy($image);
    return($newImage);
}

?>
