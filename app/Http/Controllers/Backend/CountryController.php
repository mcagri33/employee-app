<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $countries = Country::paginate(15);
        if($request->has('search')){
            $countries = Country::where('name','like',"%{$request->search}%")->orWhere('country_code','like',"%{$request->search}%")->get();
        }
        return view('countries.index',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('countries.add');
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
            'country_code' => 'required|max:3'

        ]);
        $countryAdd = new Country();
        $countryAdd->name = $request->name;
        $countryAdd->country_code = $request->country_code;
        $countryAdd->save();
        return redirect()->route('castle.country.index')->with('success', 'Success!');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        $countryId = Country::find($id);
        return view('countries.edit',compact('countryId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'country_code' => 'required|max:3'

        ]);
        $countryUpdate = Country::findOrFail($request->id);
        $countryUpdate->name = $request->name;
        $countryUpdate->country_code = $request->country_code;
        $countryUpdate->update();
        return redirect()->route('castle.country.index')->with('success', 'Success!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $countryDestroy = Country::find($id);
        $countryDestroy->delete();
        return redirect()->route('castle.country.index')->with('success', 'Success!');

    }
}
