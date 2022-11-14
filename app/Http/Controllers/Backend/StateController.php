<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $states = State::paginate(15);
        if($request->has('search')){
            $states = State::where('name','like',"%{$request->search}%")->orWhere('country_code','like',"%{$request->search}%")->get();
        }

        return view('state.index',compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $countries = Country::all();
        return view('state.add',compact('countries'));
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
            'name' => 'required',
            'country_id' => 'required'
        ]);

        State::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
        ]);
        return redirect()->route('castle.state.index')->with('success', 'Success!');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        $stateEdit = State::find($id);
        $countries = Country::all();

        return view('state.edit',compact('stateEdit','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $stateUpdate = State::findOrFail($request->id);
        $stateUpdate->name = $request->name;
        $stateUpdate->country_id = $request->country_id;
        $stateUpdate->update();
        return redirect()->route('castle.state.index')->with('success', 'Success!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $stateDelete = State::find($id);
        $stateDelete->delete();
        return redirect()->route('castle.state.index')->with('success', 'Success!');
    }
}
