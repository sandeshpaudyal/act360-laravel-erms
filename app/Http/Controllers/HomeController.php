<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Department;
use App\Employee;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {
       $departments = Department::all();

       $employees = Employee::all();

        return view('home', compact('departments','employees'));


    }
}
