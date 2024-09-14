<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Status;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard() {
        $user = $this->user();
        return view('dashboard', compact('user'));
    }

    public function postJobPage()  {
        $categories = Category::all();
        $types = Type::all();
        return view('post-job', compact('categories', 'types'));
    }

    public function jobCategories() {
        $user = $this->user();
        $categories = Category::all();
        $open_status = Status::where('name', 'open')->first()->id;
        $jobs = Job::where('status_id', $open_status)->latest()->paginate(15);
        return view('job-categories', compact('categories', 'jobs', 'open_status', 'user'));
    }

    public function jobs(Category $category) {
        $user = $this->user();
        $open_status = Status::where('name', 'open')->first()->id;
        $jobs = $category->jobs()->where('status_id', $open_status)->latest()->paginate(15);
        $jobs_count = $category->jobs()->where('status_id', $open_status)->count();
        return view('jobs', compact('jobs', 'category', 'jobs_count', 'user'));
    }

    public function apply(Job $job, Request $request) {
        if($this->user()->id == $job->user_id) back();
        $this->validate(request(), [
            'application_letter' => 'required',
        ]);

        if($request->hasFile('file')) {
            $file_url = $request->file('file')->store('public/attachments');
            $file_name = str_replace("public/", "", $file_url);
        } else return back()->with('danger', 'Please choose an image');

        $pending_status = Status::where('name', 'pending')->first()->id;
        $job->applications()->create($request->all()+ ['attachment' => $file_name, 'status_id' => $pending_status]);
        return back()->with('success', 'Job application submitted successfully. The recruiter will get back to you soon. Keep sending those applications!');
    }

    public function postJob(Request $request)  {
        $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
            'salary' => 'required|numeric',
            'company' => 'required',
            'location' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
        ]);
        $is_negotiable = $request->is_negotiable ? 1 : 0;
        $this->user()->jobs()->create($request->all() + ['is_negotiable' => $is_negotiable, 'status_id' => Status::where('name', 'open')->first()->id]);
        return back()->with('success', "Job Posted Successfully! You'll start receiving job applications from workers soon!");
    }

    public function viewApplications() {
        $applications = $this->user()->applications()->latest()->get();
        return view('dashboard.view-job-applications', compact('applications'));
    }

    public function manageJobs() {
        $jobs = $this->user()->jobs()->get();
        $accepted_status = Status::where('name', 'accepted')->first()->id;
        return view('dashboard.manage-jobs', compact('jobs', 'accepted_status'));
    }

    public function changeJobStatus(Job $job, Request $request) {
        if(strtolower($request->status) == 'close job') $status = Status::where('name', 'closed')->first();
        else $status = Status::where('name', 'open')->first();
        $job->status_id = $status->id;
        $job->save();

        return back()->with('success', 'Job status changed successfully!');
    }

    public function editJob(Job $job) {
        $jobs = $this->user()->jobs()->get();
        $categories = Category::all();
        $types = Type::all();
        return view('dashboard.edit-job', compact('job','categories', 'types'));
    }

    public function updateJob(Request $request, Job $job) {
        $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
            'salary' => 'required|numeric',
            'company' => 'required',
            'location' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
        ]);
        $is_negotiable = $request->is_negotiable ? 1 : 0;
        $job->update($request->all() + ['is_negotiable' => $is_negotiable]);
        return back()->with('success', "Job Updated Successfully!");
    }

    public function manageProfile() {
        $user = $this->user();
        return view('dashboard.manage-profile', compact('user'));
    }

    public function updateProfile(Request $request) {
        $this->validate(request(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
        ]);
        $user = $this->user();
        $user->update($request->all());
        return back()->with('success', 'Profile updated successfully!');
    }

    public function changePassword(Request $request) {
        $user = $this->user();
        $this->validate(request(), [
            'old_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed'
        ]);
        if($user->passwordCheck($request->old_password)) {
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success', 'Password changed successfully!');
        } else session()->flash('danger', 'Wrong password. Please try again!');
        return back();
    }

    public function manageJobApplications(Job $job, Request $request) {
        if($request->application_status) {
            $applications = $job->applications()->where('status_id', $request->application_status)->latest()->get();
        } else {
            $applications = $job->applications()->latest()->get();
        }
        return view('dashboard.job-applications', compact('applications', 'job'));
    }

    public function changeApplicationStatus(JobApplication $application, Request $request) {
        if(strtolower($request->status) == 'accept') $status = Status::where('name', 'accepted')->first();
        else $status = Status::where('name', 'rejected')->first();
        $application->status_id = $status->id;
        $application->save();

        return back()->with('success', 'Job application '.$status->name.' successfully!');
    }

    public function user() {
        return Auth::user();
    }
}
