<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuaris = User::all();
        return view('usuaris.index', compact('usuaris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuaris.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
        ]);

        User::create([
        'name' => $request->name,   // o 'nom' segons la teva taula
        'email' => $request->email,
        'password' => bcrypt('123456'), // contrasenya per defecte
    ]);
        return redirect()->route('usuaris.index');
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
        $usuari = User::findOrFail($id);
        return view('usuaris.edit', compact('usuari'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuari = User::findOrFail($id);
        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $usuari->id,
        'password' => 'nullable|string|min:6',
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    // Si l’usuari ha escrit una nova contrasenya, la guardem
    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }
    $usuari->update($data);

    return redirect()->route('usuaris.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuari = User::findOrFail($id);
        $usuari->delete();
        return redirect()->route('usuaris.index');
    }
}
