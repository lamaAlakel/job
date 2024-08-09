<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function browseCompany(){
        $companies = User::all();
       return response()->json([
           'status'=>true ,
           'companies'=> $companies
       ]);
    }
    public function deleteCompany($user_id){
        $deleteCompany = User::find($user_id);
        if(!$deleteCompany)
            return response()->json([
                'status'=>false ,
                'message'=>'no company'
            ]);
        $deleteCompany->delete();

        return response()->json([
            'status'=>'success',
            'message'=>'deleted successfully'
        ]);
    }
}
