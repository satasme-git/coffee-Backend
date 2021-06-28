<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
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
 protected function getAllsubcategory()
    {
        // if (empty($req->id)) {
            $data = [];
            $subcategory = DB::table('subcategory')->get()->all();
            foreach ($subcategory as $subcat) {
                unset($details);
                $name = $subcat->name;
                $subcatid = "" . $subcat->id;
                 $color = $subcat->color;
                $image = 'http://satasmemiy.tk/images/subcategory/' . $subcat->image;
        
                $data[] = collect(['name' => $name, 'id' => $subcatid, 'image' => $image,'color'=> $color]);
            }
        // } 
        return json_encode($data);
    }
    // protected function getSubcategoryWithFood(Request $req)
    // {
    //     if (empty($req->id)) {
    //         $data['subcategory'] = DB::table('foods')
    //                ->join('subcategory', 'subcategory.id', '=','foods.subcategory_id' )
    //                ->select('foods.*', 'subcategory.name as subcategory')
    //                ->get();
    //     } else {
    //         $id =$req->get('id');
    //         $data['subcategory'] = DB::table('foods')
    //         ->join('subcategory', 'subcategory.id', '=','foods.subcategory_id' )
    //         ->select('foods.*', 'subcategory.name as subcategory')
    //                ->where('subcategory.id', $id)
    //                ->get();
    //     }

    //    return json_encode($data);
    // }

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

    // protected function getExtra(Request $req)
    // {
    //     if (empty($req->id)) {
    //         $data=[];
    //         $category = DB::table('category')->get()->all();
    //            foreach($category as $cat){
    //                $name=$cat->name;
    //                $catid=$cat->id;
    //             $details[] = DB::table('foods')
    //             ->where('foods.category_id', $cat->id)
    //             ->get();
    //             $data[]=collect(['name'=> $name,'id'=> $catid,'details'=>$details]);
    //         }
    //     }

    //    return json_encode($data);
    // }

    protected function getSubcategoryWithFood(Request $req)
    {
        if (empty($req->id)) {
            $data = [];
            $subcategory = DB::table('subcategory')->get()->all();
            foreach ($subcategory as $subcat) {
                unset($details);
                $name = $subcat->name;
                $subcatid = "" . $subcat->id;
                $image = 'http://satasmemiy.tk/images/subcategory/' . $subcat->image;
                $details = DB::table('foods')
                    ->where('foods.subcategory_id', $subcatid)
                    ->get();
                $data[] = collect(['name' => $name, 'id' => $subcatid, 'image' => $image, 'details' => $details]);
            }
        } else {
            $data = [];
            $subcategory = DB::table('subcategory')
                ->get()
                ->where('id', $req->get('id'))
                ->all();
            foreach ($subcategory as $subcat) {
                unset($details);
                $name = $subcat->name;
                $subcatid = $subcat->id;
                $details = DB::table('foods')
                    ->where('foods.subcategory_id', $subcatid)
                    ->get();
                $data[] = collect(['name' => $name, 'id' => $subcatid, 'details' => $details]);
            }
        }
        return json_encode($data);
    }
    protected function getFoodById(Request $req)
    {
        
        
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
                
            $addExtra= DB::table('coffee_add_extra')
                ->where('coffee_add_extra.food_id', $req->id)
                ->get();
            $data = collect(['name' => $name,'price'=>$price, 'id' => $subcatid, 'details' => $details, 'data' => $addExtra]);

        }

        // $applications = DB::table('foods')
        //     ->join('sizes', 'foods.id', '=', 'sizes.food_id')
        //     ->select('foods.*', 'sizes.food_id', 'sizes.price', 'sizes.size')
        //     ->where('foods.id', $req->id)
        //     ->get();

        return $data;
    }
}
