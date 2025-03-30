<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class BookmarkController extends Controller
{
   public function index() {
    $user = auth()->user();
       $bookmarks = $user->bookMarkedJobs()->paginate(3); 
       return view('jobs.bookmarks')->with('bookmarks', $bookmarks);
   }

   public function store(Job $job) {
       $user = auth()->user();
       if($user->bookMarkedJobs()->where('job_id', $job->id)->exists()) {
           return back()->with('error', 'Job already bookmarked');
       }
       $user->bookMarkedJobs()->attach($job);
       return back()->with('success', 'Job bookmarked successfully');
   }

   public function destroy(Job $job) {   
       $user = auth()->user();
       if(!$user->bookMarkedJobs()->where('job_id', $job->id)->exists()) {
           return back()->with('error', 'Job not bookmarked');
       }
       $user->bookMarkedJobs()->detach($job);
       return back()->with('success', 'Job bookmark removed successfully');
   }
}
