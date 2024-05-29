<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function showJobs()
    {
        $jobs=Job::all();

        return response()->json([
           'status'=>true,
           'jobs'=>$jobs
       ]);

    }

    public function getPendingJobs()
    {
        $pendingJobs = Job::where('type', 'pending')->get();

        return response()->json([
            'pendingJobs'=> $pendingJobs
        ]);
    }
    public function getApprovedJobs()
    {
        $approvedJobs = Job::where('type', 'approved')->get();

        return response()->json([
            'approvedJobs'=> $approvedJobs
        ]);
    }

    public function approveJob($job_id)
    {
        $job = Job::find($job_id);
        if(!$job)
            return response()->json([
                'message' => 'no job'
            ]);

        $job->type ='approved';
        $job->save();

        return response()->json([
            'status'=>'success',
            'message'=>'approved successfully'
        ]);
    }

    public function deleteJob($job_id)
    {
        $job = Job::find($job_id);
        if(!$job)
            return response()->json([
                'message' => 'no job'
            ]);

        $job->delete() ;
        $job->save();

        return response()->json([
            'status'=>'success',
            'message'=>'deleted successfully'
        ]);
    }

}
