<?php

namespace App\Http\Controllers;

use App\Models\Tasca;
use App\Models\User;
use App\Models\Prioritat;
use App\Models\Estat;
use Illuminate\Http\Request;

class TascaController extends Controller
{
    public function dashboard()
    {
        $with = ['usuari','prioritat','estat'];

        $todo = Tasca::with($with)->whereHas('estat', fn($q) => $q->where('nom','ToDo'))->get();
        $doing = Tasca::with($with)->whereHas('estat', fn($q) => $q->where('nom','Doing'))->get();
        $done = Tasca::with($with)->whereHas('estat', fn($q) => $q->where('nom','Done'))->get();

        return view('dashboard', compact('todo','doing','done'));
    }

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
    public function updateEstat(Request $request, $id)
    {
        $tasca = Tasca::findOrFail($id);

        // Validem que arriba un estat_id vàlid
        $request->validate([
            'estat_id' => 'required|exists:estats,id',
        ]);

        // Actualitzem la tasca
        $tasca->estat_id = $request->estat_id;
        $tasca->save();

        return response()->json(['success' => true]);
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
