<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function addSubCategory($request){

        $subcategory= SubCategory::create([
            'name'=> $request['name']
        ]);
        return response()->json([
            'status'=>true ,
            'message'=>'add subcategory successfully'
        ]);
    }

    public function deleteSubCategory($subcategory_id){
        if(!$subcategory_id)
            return response()->json([
                'status'=> false,
                'message'=>'no subcategory'
            ]);
        $subcategory_id ->delete();
        $subcategory_id -> save();
        return response()->json([
            'message' => 'deleted successfully'], 200);
    }
    public function showSubCategory(){

        $subcategories = SubCategory::all();
        return response()->json([
            'message' => 'deleted successfully',
            'subcategories' => $subcategories ,
        ]);


    }
}
