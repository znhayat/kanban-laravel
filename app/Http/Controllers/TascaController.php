<?php

namespace App\Http\Controllers;

use App\Models\Tasca;
use App\Models\User;
use App\Models\Prioritat;
use App\Models\Estat;
use Illuminate\Http\Request;

class TascaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasques = Tasca::with(['usuari','prioritat','estat'])->get();
        return view('tasques.index', compact('tasques'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuaris = User::all();
        $prioritats = Prioritat::all();
        $estats = Estat::all();

        return view('tasques.create', compact('usuaris','prioritats','estats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titol' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'usuari_id' => 'required|exists:users,id',
            'prioritat_id' => 'required|exists:prioritats,id',
            'estat_id' => 'required|exists:estats,id',
        ]);

        Tasca::create($request->only('titol','descripcio','usuari_id','prioritat_id','estat_id'));

        return redirect()->route('tasques.index')->with('success','Tasca creada correctament!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tasca = Tasca::findOrFail($id);
        $usuaris = User::all();
        $prioritats = Prioritat::all();
        $estats = Estat::all();

        return view('tasques.edit', compact('tasca','usuaris','prioritats','estats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tasca = Tasca::findOrFail($id);

        $request->validate([
            'titol' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'usuari_id' => 'required|exists:users,id',
            'prioritat_id' => 'required|exists:prioritats,id',
            'estat_id' => 'required|exists:estats,id',
        ]);

        $tasca->update($request->only('titol','descripcio','usuari_id','prioritat_id','estat_id'));

        return redirect()->route('tasques.index')->with('success','Tasca actualitzada correctament!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tasca = Tasca::findOrFail($id);
        $tasca->delete();

        return redirect()->route('tasques.index')->with('success','Tasca eliminada correctament!');
    }
}
