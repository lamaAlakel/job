<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function addCategory(Request $request){
        $category= Category::create([
            'name'=> $request['name']
        ]);
    return response()->json([
        'status'=>true ,
        'category'=> $category,
        'message'=>'add category successfully'
    ], 201);
    }

    public function deleteCategory($category_id){
        if(!$category_id)
            return response()->json([
                'status'=> false,
                'message'=>'no category'
            ]);
        $category_id ->delete();

        return response()->json([
            'message' => 'deleted successfully'], 200);
    }
    public function showCategory(){

        $categories = Category::all();
        return response()->json([
            'message' => 'deleted successfully',
          'categories' => $categories ,
        ]);


}
}
