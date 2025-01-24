<?php

namespace App\Http\Controllers;

use App\Models\Thing; 
use Illuminate\Http\Request;

class ThingController extends Controller
{
    public function index()
    {
        $things = Thing::all(); 
        return view('things.index', compact('things')); 
    }

    public function create()
    {
        return view('things.create'); 
    }
    public function show(Thing $thing)
{
    return view('things.show', compact('thing'));
}


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'wrnt' => 'nullable|date', 
        ]);

        Thing::create([
            'name' => $request->name,
            'description' => $request->description,
            'wrnt' => $request->wrnt,
            'master' => auth()->id(), 
        ]);

        return redirect()->route('things.index'); 
    }

    public function edit(Thing $thing)
    {
        return view('things.edit', compact('thing')); 
    }

    public function update(Request $request, Thing $thing)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'wrnt' => 'nullable|date',
        ]);

        $thing->update([
            'name' => $request->name,
            'description' => $request->description,
            'wrnt' => $request->wrnt,
        ]);

        return redirect()->route('things.index'); 
    }

    public function destroy(Thing $thing)
    {
        $thing->delete();
        return redirect()->route('things.index'); 
    }

    public function repairThings()
    {
        $things = Thing::where('status', 'repair')->get(); 
        return view('things.repair', compact('things')); 
    }

    public function workThings()
    {
        $things = Thing::where('status', 'work')->get(); 
        return view('things.work', compact('things')); 
    }

    public function usedThings()
    {
        $things = Thing::where('is_used_by_other_user', true)->get(); 
        return view('things.used', compact('things')); 
    }

    public function allThings()
    {
        $things = Thing::all(); 
        return view('things.all', compact('things')); 
    }

    public function myThings()
    {
        
        if (!auth()->check()) {
            return redirect()->route('login'); 
        }
    
        $things = Thing::where('master', auth()->id())->get();
        
        return view('things.my', compact('things'));
    }
}
