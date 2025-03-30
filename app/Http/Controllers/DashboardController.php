<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $jobs = Job::where('user_id', $user->id)->with('applicants')->get();
        return view('dashboard.index' , compact('jobs', 'user'));
    }
}
