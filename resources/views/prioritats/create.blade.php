@extends('layouts.app')

@section('content')
<h1 class="title">Afegir prioritat</h1>

<form action="{{ route('prioritats.store') }}" method="POST">
    @csrf

    <label>Nom</label>
    <input type="text" name="nom" value="{{ old('nom') }}" required>
    @error('nom') <div class="alert-error">{{ $message }}</div> @enderror

    <label>Color</label>
    <input type="color" name="color" value="{{ old('color', '#888888') }}">
    @error('color') <div class="alert-error">{{ $message }}</div> @enderror

    <button class="btn btn-green">Guardar</button>
</form>

@endsection
