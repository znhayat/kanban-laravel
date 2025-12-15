<?php

namespace App\Http\Controllers;

use App\Models\Estat;
use Illuminate\Http\Request;

class EstatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estats = Estat::all();
        return view('estats.index', compact('estats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('estats.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nom' => ['required', 'regex:/^[A-Za-zÀ-ÿ\s]+$/', 'max:255'],
        ], [
            'nom.regex' => 'El nom només pot contenir lletres i espais.',
        ]);

        Estat::create($request->only('nom'));
        return redirect()->route('estats.index')->with('success','Estat creat correctament!');
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
        $estat = Estat::findOrFail($id);
        return view('estats.edit', compact('estat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'nom' => ['required', 'regex:/^[A-Za-zÀ-ÿ\s]+$/', 'max:255'],
        ], [
            'nom.regex' => 'El nom només pot contenir lletres i espais.',
        ]);

        $estat = Estat::findOrFail($id);
        $estat->update($request->only('nom'));
        return redirect()->route('estats.index')->with('success', 'Estat actualitzat correctament.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $estat = Estat::findOrFail($id);
        $estat->delete();

        return redirect()->route('estats.index')->with('success', 'Estat eliminat correctament.');
    }
}
