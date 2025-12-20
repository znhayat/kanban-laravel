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
        // Aquí faig servir aquest array perquè vull carregar les relacions
        // usuari, prioritat i estat de cop i així no fa 2000 consultes.
        $with = ['usuari','prioritat','estat'];

        // Agafo totes les tasques que estan en estat "ToDo"
        // perquè les necessito per pintar la columna del Kanban.
        $todo = Tasca::with($with)->whereHas('estat', fn($q) => $q->where('nom','ToDo'))->get();

        // El mateix però per la columna Doing
        $doing = Tasca::with($with)->whereHas('estat', fn($q) => $q->where('nom','Doing'))->get();

        // I aquí les que estan en Done
        $done = Tasca::with($with)->whereHas('estat', fn($q) => $q->where('nom','Done'))->get();

        // Envio les tres llistes a la vista del dashboard perquè es pintin al Kanban
        return view('dashboard', compact('todo','doing','done'));
    }

    /**
     * Display a listing of the resource.
     * Aquí faig servir aquest mètode perquè necessito mostrar totes les tasques
     * amb tota la seva info (usuari, prioritat, estat). És com la vista general.
     */
    public function index()
    {
        // Carrego les tasques amb les relacions perquè així no peta el Blade
        $tasques = Tasca::with(['usuari','prioritat','estat'])->get();

        // Envio les tasques a la vista
        return view('tasques.index', compact('tasques'));
    }

    /**
     * Show the form for creating a new resource.
     * Aquí només obro el formulari de crear una tasca i li passo tot el que necessita:
     * usuaris, prioritats i estats perquè pugui triar.
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
     * Aquí faig servir validació perquè no vull que es creïn tasques amb dades rares.
     * Si tot està bé, la guardo i ja està.
     */
    public function store(Request $request)
    {
        // Validació de tots els camps importants
        $request->validate([
            'titol' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'usuari_id' => 'required|exists:users,id',
            'prioritat_id' => 'required|exists:prioritats,id',
            'estat_id' => 'required|exists:estats,id',
            'data_finalitzacio' => 'nullable|date', 
        ]);

        // Creo la tasca amb només els camps que necessito
        Tasca::create($request->only('titol','descripcio','usuari_id','prioritat_id','estat_id'));

        // Torno a la llista amb un missatge d’èxit
        return redirect()->route('tasques.index')->with('success','Tasca creada correctament!');
    }

    /**
     * Show the form for editing the specified resource.
     * Aquí recupero la tasca i totes les opcions perquè l’usuari pugui editar-la.
     */
    public function edit(string $id)
    {
        // Busco la tasca o error si no existeix
        $tasca = Tasca::findOrFail($id);

        // Agafo totes les opcions per omplir el formulari
        $usuaris = User::all();
        $prioritats = Prioritat::all();
        $estats = Estat::all();

        // Envio tot a la vista d’edició
        return view('tasques.edit', compact('tasca','usuaris','prioritats','estats'));
    }

    public function show(string $id)
    {
        // Aquest mètode no el faig servir perquè no necessito mostrar una tasca sola
    }

    /**
     * Update the specified resource in storage.
     * Aquí faig servir validació igual que al store i després actualitzo la tasca.
     */
    public function update(Request $request, string $id)
    {
        // Busco la tasca que vull modificar
        $tasca = Tasca::findOrFail($id);

        // Validació perquè tot segueixi sent correcte
        $request->validate([
            'titol' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'usuari_id' => 'required|exists:users,id',
            'prioritat_id' => 'required|exists:prioritats,id',
            'estat_id' => 'required|exists:estats,id',
            'data_finalitzacio' => 'nullable|date', 
        ]);

        // Actualitzo només els camps que m’interessen
        $tasca->update($request->only('titol','descripcio','usuari_id','prioritat_id','estat_id'));

        // Torno a la llista amb un missatge d’èxit
        return redirect()->route('tasques.index')->with('success','Tasca actualitzada correctament!');
    }

    public function updateEstat(Request $request, $id)
    {
        // Busco la tasca que vull canviar d’estat
        $tasca = Tasca::findOrFail($id);

        // Validem que arriba un estat_id vàlid (per evitar errors o trolls)
        $request->validate([
            'estat_id' => 'required|exists:estats,id',
        ]);

        // Actualitzem la tasca amb el nou estat
        $tasca->estat_id = $request->estat_id;
        $tasca->save();

        // Retorno JSON perquè això ho crida el drag & drop
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     * Aquí elimino una tasca concreta. Si existeix, la borro i ja està.
     */
    public function destroy(string $id)
    {
        // Busco la tasca o error si no existeix
        $tasca = Tasca::findOrFail($id);

        // La borro de la BD
        $tasca->delete();

        // Torno a la llista amb un missatge d’èxit
        return redirect()->route('tasques.index')->with('success','Tasca eliminada correctament!');
    }
}
