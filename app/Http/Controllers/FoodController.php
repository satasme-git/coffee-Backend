<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Redirect;
class FoodController extends Controller
{
    public function __construct()
    {
        // if(empty(Session::get('user_email'))){
 
        //     Redirect::to('/')->send();
        //   }
    }
    protected function getfoods(Request $req)
    {
        if (empty($req->id)) {
            $data['food'] = DB::table('foods')
                ->join('category', 'category.id', '=', 'foods.category_id')
                ->join('subcategory', 'subcategory.id', '=', 'foods.subcategory_id')
                ->select('foods.*', 'category.name as category')
                ->addSelect('foods.*', 'subcategory.name as subcategory')
                ->get();
        } else {
            $id = $req->get('id');
            $data['food'] = DB::table('foods')
                ->join('category', 'category.id', '=', 'foods.category_id')
                ->join('subcategory', 'subcategory.id', '=', 'foods.subcategory_id')
                ->select('foods.*', 'category.name as category')
                ->addSelect('foods.*', 'subcategory.name as subcategory')
                ->where('foods.id', $id)
                ->get();
        }

        return json_encode($data);
    }

    protected function getCategory(Request $req)
    {
        if (empty($req->id)) {
            $data['category'] = DB::table('category')->get()->all();
        } else {
            $id = $req->get('id');
            $data['category'] = DB::table('category')->where('category.id', $id)
                ->get();
        }

        return json_encode($data);
    }

    protected function getSubCategory(Request $req)
    {
        if (empty($req->id)) {
            $data['subcategory'] = DB::table('subcategory')->get()->all();
        } else {
            $id = $req->get('id');
            $data['subcategory'] = DB::table('subcategory')->where('subcategory.id', $id)
                ->get();
        }

        return json_encode($data);
    }


    protected function getCategoryWithFood(Request $req)
    {
        if (empty($req->id)) {
            $data['category'] = DB::table('foods')
                ->join('category', 'category.id', '=', 'foods.category_id')
                ->select('foods.*', 'category.name as category')
                ->get();
        } else {
            $id = $req->get('id');
            $data['category'] = DB::table('foods')
                ->join('category', 'category.id', '=', 'foods.category_id')
                ->select('foods.*', 'category.name as category')
                ->where('category.id', $id)
                ->get();
        }

        return json_encode($data);
    }

  

    protected function getSubcategoryWithFood(Request $req)
    {
        if (empty($req->id)) {
            $data = [];
            $subcategory = DB::table('subcategory')->get()->all();
           
        } else {
            $data = [];
            $subcategory = DB::table('subcategory')
                ->get()
                ->where('id', $req->get('id'))
                ->all();
            
        }
        return json_encode($data);
    }
    protected function getAllsubcategory()
    {
       
    }
    


    protected function getFoodById(Request $req)
    {
     $coffee_sizes;
        $coffee_add_extra_new;
        $details = DB::table('sizes2')
            ->where('sizes2.food_id', $req->id)
            ->get();
        $addExtras = DB::table('coffee_add_extra_new')
            ->where('coffee_add_extra_new.food_id', $req->id)
            ->get();

        if (!$details->isEmpty()) {
            foreach ($details as $detail) {
                $small = $detail->small;
                $medium = $detail->medium;
                $large = $detail->large;
                $food_id = $detail->food_id;
                $coffee_sizes = [

                    ['id' => 1, 'size' => 'Small', 'price' => $small, 'food_id' => $food_id],
                    ['id' => 2, 'size' => 'Medium', 'price' => $medium, 'food_id' => $food_id],
                    ['id' => 3, 'size' => 'Large', 'price' => $large, 'food_id' => $food_id],
                ];

            }
        } else {
            $coffee_sizes = [];
        }

        if (!$addExtras->isEmpty()) {
            foreach ($addExtras as $addExtra) {
                $full_cream = $addExtra->full_cream;
                $skim = $addExtra->skim;
                $soy = $addExtra->soy;
                $almond = $addExtra->almond;
                $oat = $addExtra->oat;
                $food_id = $addExtra->food_id;
                $coffee_add_extra_new = [

                    ['food_id' => $food_id, 'id' => 1, 'val' => $full_cream, 'label' => 'Full Cream'],
                    ['food_id' => $food_id, 'id' => 2, 'val' => $skim, 'label' => 'Skim'],
                    ['food_id' => $food_id, 'id' => 3, 'val' => $soy, 'label' => 'Soy'],
                    ['food_id' => $food_id, 'id' => 4, 'val' => $almond, 'label' => 'Almond'],
                    ['food_id' => $food_id, 'id' => 5, 'val' => $oat, 'label' => 'Oat'],

                ];

            }
        } else {
            $coffee_add_extra_new = [];
        }

        $data = [];
        $foods = DB::table('foods')
            ->select('foods.*')
            ->where('foods.id', $req->id)
            ->get();
        foreach ($foods as $food) {
            unset($details);
            $name = $food->name;
            $subcatid = "" . $food->id;
            $price = $food->price;
            $details = DB::table('sizes')
                ->where('sizes.food_id', $req->id)
                ->get();
           
        }

        // $applications = DB::table('foods')
        //     ->join('sizes', 'foods.id', '=', 'sizes.food_id')
        //     ->select('foods.*', 'sizes.food_id', 'sizes.price', 'sizes.size')
        //     ->where('foods.id', $req->id)
        //     ->get();

        return $data;
    }
}
