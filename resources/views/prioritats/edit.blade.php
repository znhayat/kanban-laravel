@extends('layouts.app')

@section('content')
<h1 class="title">Editar prioritat</h1>

<form action="{{ route('prioritats.update', $prioritat) }}" method="POST">
    @csrf @method('PUT')

    <label>Nom</label>
    <input type="text" name="nom" value="{{ old('nom', $prioritat->nom) }}" required>
    @error('nom') <div class="alert-error">{{ $message }}</div> @enderror

    <label>Color</label>
    <input type="color" name="color" value="{{ old('color', $prioritat->color) }}">
    @error('color') <div class="alert-error">{{ $message }}</div> @enderror

    <button class="btn btn-blue">Actualitzar</button>
</form>

@endsection
