<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function showJobs()
    {
        $admin = Auth::guard('admin')->user();
        $jobs=Job::all();
       return response()->json([
           'status'=>true,
           'jobs'=>$jobs
       ]);

    }

    public function pendingJobs()
    {
        $admin = Auth::guard('admin')->user();
        $pendingJobs = Job::where('approved', false)->get();
        return response()->json([
            'pendingJobs'=> $pendingJobs
        ]);
    }

    public function approveJob(Job $job)
    {
        $admin = Auth::guard('admin')->user();
        $job = Job::where('approved', false)->get();
        $job->approved = true;
        $job->save();
        return response()->json([
            'status'=>'success',
            'message'=>'approved successfully'
        ]);
    }
}
