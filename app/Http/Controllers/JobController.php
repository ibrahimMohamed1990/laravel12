<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobController extends Controller
{

    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs= Job::paginate(3);
        return view('jobs.index')->with('jobs', $jobs);
        //return view('jobs.index',compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    public function search()
    {
        $keyword = request('keywords');
        $location = request('location'); 
        $jobs = Job::where('title', 'like', '%' . $keyword . '%')->where('address', 'like', '%' . $location . '%')->paginate(6);
        return view('jobs.index')->with('jobs', $jobs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            //dd($request->file('company_logo'));
            $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'company_website' => 'nullable|url'
        ]);
        $validatedData['user_id'] = auth()->user()->id;

        if($request->hasFile('company_logo')) {
            $file = $request->file('company_logo')->store('logos', 'public');
            $validatedData['company_logo'] = $file;
          
        }
         Job::create($validatedData); 
        return redirect()->route('jobs.index')->with('success', 'Job listing created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {  
        return view('jobs.show')->with('job', $job);    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $this->authorize('update', $job);
        return view('jobs.edit')->with('job', $job);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        //dd($request->file('company_logo'));
        $this->authorize('update', $job);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_website' => 'nullable|url'
        ]);
        if($request->hasFile('company_logo')) {
            Storage::disk('public')->delete('logos/' . basename($job->company_logo));

            $file = $request->file('company_logo')->store('logos', 'public');
            $validatedData['company_logo'] = $file;
        }
        $job->update($validatedData);
        return redirect()->route('jobs.index')->with('success', 'Job listing updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = Job::findOrFail($id);
        $this->authorize('delete',  $job);
        
        Storage::disk('public')->delete('logos/' . basename($job->company_logo));
        $job->delete();
        if(request()->query('from') == 'dashboard') {
            return redirect()->route('dashboard')->with('success', 'Job listing deleted successfully!');
        }
        return redirect()->route('jobs.index')->with('success', 'Job listing deleted successfully!');
    }
}
