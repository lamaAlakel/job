<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function createJob(Request $request)
    {
        $company = Auth::guard('company')->user();
        if (!$company) {
            return Response()->json([
                'message' => 'no company'], 404);
        }

        $sub_category = SubCategory::where('name' , $request['sub_category_id'])->first() ;

        $job = Job::create([
            'user_id' => $company->id,
            'sub_category_id'=> $sub_category->id,
            'title' => $request['title'],
            'description' => $request['description'],
            'location' => $request['location'],
            'on_site' => $request['on_site'],
            'full_time' => $request['full_time'],
            'max_salary' => $request['max_salary'],
            'min_salary' => $request['min_salary'],
            'image' => $request['image'],
            'type'=>$request['type'],
        ]);
        $job->save();
        return response()->json([
            'message' => 'created job successfully',
            'job' => $job], 201);
    }

    public function updateJob(Request $request ,$job_id){

        $company = Auth::guard('company')->user();
        $job = Job::find($job_id);
        if(!$job)
            return response()->json([
                'message' => 'no job'
            ]);
        if (!$company) {
            return Response()->json([
                'message' => 'no company'], 404);
        }
        if($job->user_id != $company->id)
            return response()->json([
                'status'=> false ,
                'message'=> 'forbidden'
            ]);

        $job->update([
            'user_id' => $company->id,
            'sub_category_id'=> $request['sub_category_id'],
            'title' => $request['title'],
            'description' => $request['description'],
            'location' => $request['location'],
            'on_site' => $request['on_site'],
            'full_time' => $request['full_time'],
            'max_salary' => $request['max_salary'],
            'min_salary' => $request['min_salary'],
            'image' => $request['image'],
            'type'=>$request['type'],
        ]);

        return response()->json([
            'message'=>'job updated successfully',
            'job'=>$job
        ]);

    }

    public function deleteJob($jobId)
    {
        $company = Auth::guard('company')->user();
        if (!$company) {
            return response()->json([
                'message' => 'no company'], 404);
        }
        $job = Job::find($jobId);
        if (!$job) {
            return response()->json([
                'message' => 'no job'], 404);
        }
        if ($job->user_id != $company->id) {
            return response()->json([
                'message' => 'forbidden'], 403);
        }
        $job->delete();
        return response()->json([
            'message' => 'deleted successfully'], 200);
    }

    public function showCompanyJobs()
    {
        $user = Auth::guard('company')->user();
        $jobs = Job::where('user_id', $user->id)->get();

        return response()->json([
            'status' => true ,
            'jobs' => $jobs
        ]);
    }

    public function JobRequest($job_id)
    {
        $company =Auth::guard('company')->id() ;
        $job = Job::find($job_id) ;
        if(!$job)
            return response()->json([
                'status'=>false ,
                'message' => 'Not found'
            ],404);

        if($job->user_id != $company)
            return response()->json([
                'status'=>false ,
                'message' => 'forbidden'
            ]);

        $requests = \App\Models\Request::with('mobile_user')->where('job_id' , $job_id)->get() ;

            return response()->json([
            'status' => true ,
            'requests' => $requests
        ]);
    }

    public function showSubCategories()
    {
        $sub_categories = SubCategory::select('name' , 'category_id')->get() ;
        return response()->json([
            'status' => 'true' ,
            'cats' => $sub_categories
        ]) ;
    }

    public function approveJobRequest($request_id)
    {
        $jobRequest = \App\Models\Request::find($request_id);
        if(!$jobRequest)
            return response()->json([
                'message' => 'no Job Request'
            ]);

        $jobRequest->type ='approved';
        $jobRequest->save();

        return response()->json([
            'status'=>'success',
            'message'=>'approved successfully'
        ]);
    }

}

