@extends('layouts.app')

@section('content')
<h1 class="title">Editar estat</h1>

<form action="{{ route('estats.update', $estat) }}" method="POST">
    @csrf @method('PUT')
    <label>Nom</label>
    <input type="text" name="nom" value="{{ $estat->nom }}" required>
    <button class="btn btn-blue">Actualitzar</button>
</form>
@endsection
