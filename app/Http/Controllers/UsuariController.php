<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuariController extends Controller
{
    public function index()
    {
        $usuaris = User::all();
        return view('usuaris.index', compact('usuaris'));
    }

    public function create()
    {
        return view('usuaris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|regex:/^[A-Za-zÀ-ÿ\s]+$/u|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ], [
            'nom.regex' => 'El nom només pot contenir lletres i espais.',
            'password.min' => 'La contrasenya ha de tenir almenys 6 caràcters.',
        ]);

        User::create([
            'name' => $request->nom,   // CORREGIT
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('usuaris.index')
                         ->with('success', 'Responsable creat correctament.');
    }

    public function edit(string $id)
    {
        $usuari = User::findOrFail($id);
        return view('usuaris.edit', compact('usuari'));
    }

    public function update(Request $request, string $id)
    {
        $usuari = User::findOrFail($id);

        $request->validate([
            'nom' => 'required|regex:/^[A-Za-zÀ-ÿ\s]+$/u|max:255',
            'email' => 'required|email|unique:users,email,' . $usuari->id,
            'password' => 'nullable|string|min:6',
        ], [
            'nom.regex' => 'El nom només pot contenir lletres i espais.',
            'password.min' => 'La contrasenya ha de tenir almenys 6 caràcters.',
        ]);


        $data = [
            'name' => $request->nom,   // CORREGIT
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $usuari->update($data);

        return redirect()->route('usuaris.index')
                         ->with('success', 'Responsable actualitzat correctament.');
    }

    public function destroy(string $id)
    {
        $usuari = User::findOrFail($id);
        $usuari->delete();

        return redirect()->route('usuaris.index')
                         ->with('success', 'Responsable eliminat correctament.');
    }
}
