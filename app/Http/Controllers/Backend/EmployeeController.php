<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use App\Models\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $employees = Employee::paginate(15);
        if($request->has('search')){
            $employees = Employee::where('name','like',"%{$request->search}%")->orWhere('country_code','like',"%{$request->search}%")->get();
        }
        $departments = Department::all();
        $countries = Country::all();
        return view('employee.index',compact('employees','departments','countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(Request $request)
    {
        $departments = Department::all();
        $countries = Country::get(["name", "id"]);
        return view('employee.add',compact('departments','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'last_name' => 'required',
            'department_id' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'first_name' => 'required',
            'zip_code' => 'required',
        ]);

        Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'address' => $request->address,
            'department_id' => $request->department_id,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'zip_code' => $request->zip_code,
            'birthdate' => $request->birthdate,
            'date_hired' => $request->date_hired,
        ]);
        return redirect()->route('castle.employee.index')->with('success', 'Success!');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        $employEdit = Employee::find($id);
        $departments = Department::all();
        $countries = Country::get(["name", "id"]);
        return view('employee.edit',compact('employEdit','departments','countries'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $employeUpdate = Employee::findOrFail($request->id);
        $employeUpdate->first_name = $request->first_name;
        $employeUpdate->last_name = $request->last_name;
        $employeUpdate->middle_name = $request->middle_name;
        $employeUpdate->address = $request->address;
        $employeUpdate->department_id = $request->department_id;
        $employeUpdate->country_id = $request->country_id;
        $employeUpdate->state_id = $request->state_id;
        $employeUpdate->city_id = $request->city_id;
        $employeUpdate->zip_code = $request->zip_code;
        $employeUpdate->birthdate = $request->birthdate;
        $employeUpdate->date_hired = $request->date_hired;
        $employeUpdate->update();
        return redirect()->route('castle.employee.index')->with('success', 'Success!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $employeDelete = Employee::find($id);
        $employeDelete->delete();
        return redirect()->route('castle.employee.index')->with('success', 'Success!');

    }

    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }
}
