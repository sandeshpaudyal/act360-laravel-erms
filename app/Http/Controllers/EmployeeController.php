<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Employee;

class EmployeeController extends Controller
{
     public function index()

    {
        $employee = Employee::all();
        return view('home', compact('employee'));

    }

    public function store(Request $request)

    {
        $validatedData = $request->validate([
         'name' => 'required|string',
         'dob' => 'required|date',
         'gender' => 'required|string',
		 'mobile_no' => 'required|numeric|min:9',
         'email' => 'required|string',
         'address' => 'required|string',
         'department' => 'required|string',
         'join_date' => 'required|date',
         'about' => 'required|string',    
       
     ]);


            $imageFile = $request->file('photo');
            $imageFilenameWithExt = $imageFile->getClientOriginalName();
            $imageFilename = pathinfo($imageFilenameWithExt, PATHINFO_FILENAME);
            $extension = $imageFile->getClientOriginalExtension();
            $imageFileNameToStore = $imageFilename . '_' . time() . '.' . $extension;

            $imagedata = [
                'image' => $imageFilename,
                'path' => $imageFile->storeAs('image', $imageFileNameToStore, 'public'),
                'meta' => 'Employee',
            ];
               // dd($imagedata);

        $employee = Employee::create($validatedData);
        $employee->image()->create($imagedata);

     return redirect('/home')->with('success', 'employee is successfully saved');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $employee = Employee::sortable()->paginate(5);
        return view('index',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

        return view('home', compact('employee'));
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
         'name' => 'string',
         'dob' => 'date',
         'gender' => 'string',
         'mobile_no' => '',
         'email' => 'string',
         'address' => 'string',
         'department' => 'string',
         'join_date' => 'date',
         'about' => 'string',  
            
        ]);

        Employee::whereId($id)->update($validatedData);

        return redirect('/home')->with('success', 'employee is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect('/home')->with('success', 'department is successfully deleted');   
    }



}
