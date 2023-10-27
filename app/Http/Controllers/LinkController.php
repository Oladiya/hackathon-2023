<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::where('user_id', null)->get();

        return view('links.index', compact('links'));

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
        $hash = Str::random(64);
        $link = Link::create(['hash' => $hash]);

        return redirect()->route('link.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $link = Link::findOrFail($id);

        $link->delete();

        return redirect()->route('link.index');
    }
}
