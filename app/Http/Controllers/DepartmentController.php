<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Session;

class DepartmentController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $departments = Department::all();
        return view('home', compact('departments'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
         //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
         'title' => 'required|max:255',
         'description' => 'required|string',
         
     ]);
     $department = Department::create($validatedData);

     return redirect('/home')->with('success', 'department is successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::findOrFail($id);

        return view('home', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|string',
            
        ]);
        Department::whereId($id)->update($validatedData);
       
        return redirect('/home')->with('success', 'department is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $department = Department::findOrFail($id);
        $department->delete();

        return redirect('/home')->with('success', 'department is successfully deleted'); 
    }

}