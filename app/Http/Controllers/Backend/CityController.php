<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $cities = City::paginate(15);
        if($request->has('search')){
            $cities = City::where('name','like',"%{$request->search}%")->orWhere('state_code','like',"%{$request->search}%")->get();
        }
        $state = State::all();
        return view('city.index',compact('cities','state'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $stateAdd = State::all();
        return view('city.add',compact('stateAdd'));
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
            'state_id' => 'required'
        ]);

        State::create([
            'name' => $request->name,
            'state_id' => $request->state_id,
        ]);
        return redirect()->route('castle.city.index')->with('success', 'Success!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        $cityEdit = City::find($id);
        $state = State::all();

        return view('city.edit',compact('cityEdit','state'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $cityUpdate = City::findOrFail($request->id);
        $cityUpdate->name = $request->name;
        $cityUpdate->state_id = $request->state_id;
        $cityUpdate->update();
        return redirect()->route('castle.city.index')->with('success', 'Success!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $cityDelete = City::find($id);
        $cityDelete->delete();
        return redirect()->route('castle.city.index')->with('success', 'Success!');

    }
}
