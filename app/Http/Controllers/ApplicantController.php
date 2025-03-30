<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Applicant;

class ApplicantController extends Controller
{
   public function store(Request $request , Job $job) {
    //check if user already applied
    if(Applicant::where('job_id', $job->id)->where('user_id', auth()->user()->id)->exists()) {
        return back()->with('error', 'You have already applied for this job');
    }
 
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'contact_email' => 'required|string|email|max:255',
            'contact_phone' => 'string|max:255',
            'message' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'resume' => 'required|file|mimes:pdf|max:2048', 
        ]);

        if($request->hasFile('resume')) {
            $file = $request->file('resume')->store('resumes', 'public'); 
            $validatedData['resume'] = $file;
        }
        $application = new Applicant($validatedData);
        $application->job_id = $job->id;
        $application->user_id = auth()->user()->id;
        $application->save();
        return back()->with('success', 'Application submitted successfully');
   }

   public function index() {
    $jobs = Job::all();
    return view('applicant.index', compact('jobs'));
   }
   public function destroy(Applicant $applicant) {   
    $applicant->delete();
    return back()->with('success', 'Application deleted successfully');
   }
}
