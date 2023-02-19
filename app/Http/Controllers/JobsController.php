<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index()
    {
        $jobs = Jobs::all()->filter(function ($job) {
            return $job->active == 1;
        });

        return view('jobs', ['openJobs' => $jobs]);
    }

    public function byId(Request $request, $id)
    {
        $job = Jobs::all()->find($id);

        return view('jobs.job', ['job' => $job]);
    }
}
