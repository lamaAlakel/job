<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function addSubCategory(Request $request){

        $subcategory= SubCategory::create([
           'category_id'=> $request['category_id'] ,
            'name'=> $request['name']
        ]);
        return response()->json([
            'status'=>true ,
            'subcategory'=> $subcategory,
            'message'=>'add subcategory successfully'
        ], 201);
    }

    public function deleteSubCategory($subcategory_id){
        $subcategory = SubCategory::find($subcategory_id) ;
        if(!$subcategory)
            return response()->json([
                'status'=> false,
                'message'=>'no subcategory'
            ]);
        $subcategory_id ->delete();

        return response()->json([
            'message' => 'deleted successfully'], 200);
    }

    public function showSubCategories(){
        $subcategories = SubCategory::with('category')->get();
        return response()->json([
            'subcategories' => $subcategories ,
        ]);
    }

}
