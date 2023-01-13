<?php

namespace App\Http\Controllers;

use App\Models\Jobs;

class JobsController extends Controller
{

    public function index() {
        $jobs = Jobs::all()->filter(function ($job) {
            return $job->active == 1;
        });

        return view('jobs', ['openJobs' => $jobs]);
    }

}
