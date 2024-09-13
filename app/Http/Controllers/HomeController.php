<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\Status;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $open_status = Status::where('name', 'open')->first()->id ?? null;
        $jobs = Job::where('status_id', $open_status)->latest()->paginate(15);
        return view('index', compact('categories', 'jobs', 'open_status'));
    }

    public function contact() {
        return view('contact');
    }

    public function about() {
        return view('about');
    }
}
