@extends('layouts.app')

@section('content')
<h1 class="title">Editar prioritat</h1>

<form action="{{ route('prioritats.update', $prioritat) }}" method="POST">
    @csrf @method('PUT')

    <label>Nom</label>
    <input type="text" name="nom" value="{{ $prioritat->nom }}" required>

    <label>Color</label>
    <input type="color" name="color" value="{{ $prioritat->color }}">

    <button class="btn btn-blue">Actualitzar</button>
</form>
@endsection
