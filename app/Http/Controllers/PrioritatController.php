<?php

namespace App\Http\Controllers;

use App\Models\Prioritat;
use Illuminate\Http\Request;

class PrioritatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prioritats = Prioritat::all();
        return view('prioritats.index', compact('prioritats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prioritats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nom' => ['required', 'regex:/^[A-Za-zÀ-ÿ\s]+$/', 'max:255'],
        'color' => ['required', 'string', 'max:7'], // uso hex (#RRGGBB)
        ], [
            'nom.regex' => 'El nom només pot contenir lletres i espais.',
        ]);

        Prioritat::create($request->only('nom','color'));
        return redirect()->route('prioritats.index')->with('success','Prioritat creada!');
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
        $prioritat = Prioritat::findOrFail($id);
        return view('prioritats.edit', compact('prioritat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $prioritat = Prioritat::findOrFail($id);

        $request->validate([
            'nom' => ['required', 'regex:/^[A-Za-zÀ-ÿ\s]+$/', 'max:255'],
            'color' => ['required', 'string', 'max:7'],
        ], [
            'nom.regex' => 'El nom només pot contenir lletres i espais.',
        ]);

        $prioritat->update($request->only('nom','color'));
        return redirect()->route('prioritats.index')->with('success','Prioritat actualitzada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prioritat = Prioritat::findOrFail($id);
        $prioritat->delete();
        return redirect()->route('prioritats.index');
    }
}
