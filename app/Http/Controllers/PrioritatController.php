<?php

namespace App\Http\Controllers;

use App\Models\Prioritat;
use Illuminate\Http\Request;

class PrioritatController extends Controller
{
    /**
     * Display a listing of the resource.
     * Aquí faig servir aquest mètode perquè vull mostrar totes les prioritats
     * que tinc guardades. És com la llista general per veure-ho tot d’un cop.
     */
    public function index()
    {
        // Agafo totes les prioritats de la BD perquè les necessito per la vista
        $prioritats = Prioritat::all();

        // Envio les prioritats a la vista perquè es puguin pintar
        return view('prioritats.index', compact('prioritats'));
    }

    /**
     * Show the form for creating a new resource.
     * Aquest mètode només serveix per obrir el formulari de crear una prioritat.
     * No fa res més perquè no cal, literalment només mostra la vista.
     */
    public function create()
    {
        return view('prioritats.create');
    }

    /**
     * Store a newly created resource in storage.
     * Aquí faig servir validació perquè no vull que la gent posi noms raros
     * o colors que no siguin un HEX. Si tot està bé, ho guardo i ja està.
     */
    public function store(Request $request)
    {
        // Validació del nom i del color (el color ha de ser tipus #RRGGBB)
        $request->validate([
            'nom' => ['required', 'regex:/^[A-Za-zÀ-ÿ\s]+$/', 'max:255'],
            'color' => ['required', 'string', 'max:7'], // uso hex (#RRGGBB)
        ], [
            // Missatge personalitzat perquè la regex és una mica tiquismiquis
            'nom.regex' => 'El nom només pot contenir lletres i espais.',
        ]);

        // Creo la prioritat amb només els camps que necessito
        Prioritat::create($request->only('nom','color'));

        // Torno a la llista amb un missatge de "tot bé"
        return redirect()->route('prioritats.index')->with('success','Prioritat creada!');
    }

    /**
     * Display the specified resource.
     * Aquest no el faig servir perquè no necessito mostrar una prioritat sola.
     * O sigui, no té sentit en aquest projecte.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * Aquí recupero la prioritat que vull editar i la passo a la vista.
     * Ho faig així perquè si no existeix, que peti amb un 404 i ja està.
     */
    public function edit(string $id)
    {
        // Busco la prioritat o error si no existeix
        $prioritat = Prioritat::findOrFail($id);

        // Envio la prioritat a la vista d’edició
        return view('prioritats.edit', compact('prioritat'));
    }

    /**
     * Update the specified resource in storage.
     * Aquí faig servir la mateixa validació que al store perquè no vull
     * que algú editi i posi coses rares. Si tot està bé, actualitzo.
     */
    public function update(Request $request, string $id)
    {
        // Busco la prioritat que vull modificar
        $prioritat = Prioritat::findOrFail($id);

        // Validació igual que abans perquè tot segueixi sent correcte
        $request->validate([
            'nom' => ['required', 'regex:/^[A-Za-zÀ-ÿ\s]+$/', 'max:255'],
            'color' => ['required', 'string', 'max:7'],
        ], [
            'nom.regex' => 'El nom només pot contenir lletres i espais.',
        ]);

        // Actualitzo només els camps que m’interessen
        $prioritat->update($request->only('nom','color'));

        // Torno a la llista amb el missatge d’èxit
        return redirect()->route('prioritats.index')->with('success','Prioritat actualitzada!');
    }

    /**
     * Remove the specified resource from storage.
     * Aquí faig servir això perquè necessito eliminar una prioritat concreta.
     * Si existeix, la borro i ja està. No té més misteri.
     */
    public function destroy(string $id)
    {
        // Busco la prioritat o error si no existeix
        $prioritat = Prioritat::findOrFail($id);

        // La borro de la BD
        $prioritat->delete();

        // Torno a la llista (sense missatge perquè no n’has posat cap)
        return redirect()->route('prioritats.index');
    }
}
