<?php

namespace App\Http\Controllers;

use App\Job;
use App\Category;
use App\Helpers\Constant;
use Illuminate\Support\Facades\Auth;


class JobController extends Api
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Trang danh sách việc làm
     */
    public function index()
    {
        $user = Auth::user();

        $jobs = Job::orderBy('created_at', 'desc')->take(20)->get();
        $categories = array_pluck(Category::all()->toArray(), 'name', 'id');
        $provinces = Constant::getProvinces();
        $salary_range = Constant::getSalaryRange();

        $var = [
            'user' => $user,
            'jobs' => $jobs,
            'categories' => $categories,
            'provinces' => $provinces,
            'salary_range' => $salary_range,
        ];
        return view('job.index', $var);
    }

    /**
     * Trang chi tiết việc làm
     */
    public function detail($slug, $id)
    {
        $user = Auth::user();

        $job = Job::find($id);
        $categories = array_pluck(Category::all()->toArray(), 'name', 'id');
        $provinces = Constant::getProvinces();
        $salary_range = Constant::getSalaryRange();
        $scale = Constant::getScale();

        $var = [
            'user' => $user,
            'job' => $job,
            'categories' => $categories,
            'provinces' => $provinces,
            'salary_range' => $salary_range,
            'scale' => $scale,
        ];
        return view('job.detail', $var);
    }
}
