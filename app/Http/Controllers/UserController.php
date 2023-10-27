<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function setAdminRights(Request $request, $id){
        $user = User::findOrFail($id);

        $user->is_admin = true;
        $user->save();

        return redirect()->route('user.index');
    }

    public function removeAdminRights(Request $request, $id){
        $user = User::findOrFail($id);

        if($user->id === auth()->id()){
            return redirect()->back()->withErrors(['self_delete' => 'Нельзя забрать права администратора у самого себя']);
        }
        $user->is_admin = false;
        $user->save();

        return redirect()->route('user.index');
    }

    public function approve(Request $request, $id){
        $user = User::findOrFail($id);

        $user->is_approved = true;
        $user->save();

        return redirect()->route('user.index');
    }

    public function reject(Request $request, $id){
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('user.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
