<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use Illuminate\Http\Request;

use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Contracts\View\Factory;

class JobsController extends Controller
{
    public function index(): View|FoundationApplication|Factory|ContractApplication
    {
        $jobs = Jobs::all()->filter(function ($job) {
            return $job->active == 1;
        });

        return view('jobs', ['openJobs' => $jobs]);
    }

    public function byId(Request $request, $id): View|FoundationApplication|Factory|ContractApplication
    {
        $job = Jobs::all()->find($id);

        return view('jobs.job', ['job' => $job]);
    }
}
