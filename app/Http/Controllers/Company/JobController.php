<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\User;
use http\Client\Response;
use Illuminate\Http\Request;

class JobController extends Controller
{
public function createJob(Request $request ,$user_id){
    $company=User::find($user_id);
    if(!$company){
        return Response()->json([
            'message'=>'no company'],404);
    }
    $job =$company->jobs()->create([
        'title'=>$request['title'],
        'description'=>$request['description'],
    ]);
    return response()->json([
        'message' => 'created job successfully',
        'job' => $job],201);
}
public function deleteJob(Request $request,$user_id,$job_id){
   $company=User::find($user_id);
   if(!$company){
       return response()->json([
           'message'=>'no company'],404);
   }
   $job=Job::where('user_id',$user_id)->find($job_id);
   if(!$job){
       return response()->json([
           'message'=>'no job'],404);
   }
   $job()->delete();
    return response()->json([
        'message'=>'deleted successfully'],200);

}
}

