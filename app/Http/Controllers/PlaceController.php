<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::all();
        return view('places.index', compact('places'));
    }

    public function create()
    {
        return view('places.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Place::create($request->all());

        return redirect()->route('places.index');
    }

    public function edit(Place $place)
    {
        return view('places.edit', compact('place'));
    }

    public function update(Request $request, Place $place)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $place->update($request->all());

        return redirect()->route('places.index');
    }

    public function destroy(Place $place)
    {
        $place->delete();
        return redirect()->route('places.index');
    }
}
