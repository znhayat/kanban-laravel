@extends('layouts.app')

@section('content')
<h1 class="title">Editar estat</h1>

<form action="{{ route('estats.update', $estat) }}" method="POST">
    @csrf @method('PUT')
    {{-- S’indica que la petició és de tipus PUT per actualitzar el registre --}}

    <label>Nom</label>
    <input type="text" name="nom" value="{{ old('nom', $estat->nom) }}" required>

    @error('nom')
        <div class="alert-error">{{ $message }}</div>
    @enderror

    <button class="btn btn-blue">Actualitzar</button>
</form>
@endsection
