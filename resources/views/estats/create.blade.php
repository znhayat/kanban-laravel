@extends('layouts.app')

@section('content')
<h1 class="title">Afegir estat</h1>

<form action="{{ route('estats.store') }}" method="POST">
    @csrf
    {{-- Aquí poso el token CSRF perquè Laravel no em deixi enviar formularis sense seguretat.
         És com la protecció anti-hackers bàsica. --}}

    {{-- Missatge d’error específic per al camp "nom".
         Ho faig així perquè si l’usuari posa un nom raro o buit,
         li surti el missatge just a sota del camp. --}}
    <label>Nom</label>
    <input type="text" name="nom" value="{{ old('nom') }}" required>
    @error('nom')
        <div class="alert-error">{{ $message }}</div>
    @enderror

    {{-- Botó per guardar l’estat nou. --}}
    <button class="btn btn-green">Guardar</button>
</form>
@endsection
