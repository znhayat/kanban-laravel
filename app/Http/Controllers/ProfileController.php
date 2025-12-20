<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     * Aquí simplement obro la vista del perfil perquè l’usuari pugui veure
     * les seves dades i editar-les. És com: “vale, aquí tens la teva info,
     * canvia el que vulguis”.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            // Aquí li passo l’usuari loguejat perquè la vista pugui omplir els camps
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     * Aquí faig servir el ProfileUpdateRequest perquè ja porta tota la validació feta
     * i així no he d’escriure-la aquí. És com: “ok, si tot està validat, ho guardo”.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Omplo l’usuari amb les dades validades (així no hi ha sorpreses)
        $request->user()->fill($request->validated());

        // Si l’usuari ha canviat l’email, li trec la verificació perquè òbviament
        // si canvies el correu, l’has de tornar a verificar.
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Guardo els canvis a la BD
        $request->user()->save();

        // Torno a la mateixa pàgina amb un missatge de “tot bé”
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     * Aquí és on l’usuari elimina el seu compte. Faig validació de la contrasenya
     * perquè òbviament no vull que algú borri el compte sense confirmar res.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validació perquè l’usuari posi la seva contrasenya abans d’esborrar el compte
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // Agafo l’usuari actual
        $user = $request->user();

        // El desloguejo perquè si no seria raro eliminar el compte i seguir loguejat
        Auth::logout();

        // Elimino l’usuari de la BD
        $user->delete();

        // Mato la sessió perquè no quedi res pendent
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // I el porto a la pàgina principal com si res
        return Redirect::to('/');
    }
}