<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {

        $users = User::all();
        if($request->has('search')){
            $users = User::where('username','like',"%{$request->search}%")->orWhere('email','like',"%{$request->search}%")->get();
        }
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('users.add');
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
            'username' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
        ]);

         User::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('castle.user.index')->with('success', 'Success!');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
       $userFind = User::find($id);
        return view('users.edit',compact('userFind'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $userUpdate = User::findOrFail($request->id);
        $userUpdate->username = $request->username;
        $userUpdate->first_name = $request->first_name;
        $userUpdate->last_name = $request->last_name;
        $userUpdate->email = $request->email;
        $userUpdate->update();
        return redirect()->route('castle.user.index')->with('success', 'Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $userDelete = User::find($id);
        $userDelete->delete();
        return redirect()->route('castle.user.index')->with('success', 'Success!');
    }

    public function password($id)
    {

        $userpass = User::find($id);
        return view('users/password',compact('userpass'));
    }

    public function passwordChange(Request $request)
    {
        $request->validate([
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        ]);
        $changePass = User::findOrFail($request->id);
        $changePass->password = Hash::make($request->password);
        $changePass->update();
        return redirect()->route('castle.user.index')->with('success', 'Success!');

    }
}
