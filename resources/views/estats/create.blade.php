@extends('layouts.app')

@section('content')
<h1 class="title">Afegir estat</h1>

<form action="{{ route('estats.store') }}" method="POST">
    @csrf

    {{-- Missatge d’error específic per al camp "nom" --}}
    <label>Nom</label>
    <input type="text" name="nom" value="{{ old('nom') }}" required>
    @error('nom')
        <div class="alert-error">{{ $message }}</div>
    @enderror

    <button class="btn btn-green">Guardar</button>
</form>
@endsection
