@extends('layout')

@section('content')
<h1 class="title">Editar responsable</h1>

<form action="{{ route('usuaris.update', $usuari) }}" method="POST" class="form">
    @csrf
    @method('PUT')

    <label>Nom</label>
    <input type="text" name="nom" value="{{ $usuari->name }}" required>

    <label>Email</label>
    <input type="email" name="email" value="{{ $usuari->email }}" required>

    <label>Contrasenya (nova)</label>
    <input type="password" name="password">

    <button class="btn btn-blue">Actualitzar</button>
</form>
@endsection
