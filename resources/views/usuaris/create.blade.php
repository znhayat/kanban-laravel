@extends('layout')

@section('content')
<h1 class="title">Afegir responsable</h1>

<form action="{{ route('usuaris.store') }}" method="POST" class="form">
    @csrf
    <label>Nom</label>
    <input type="text" name="name" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Contrasenya</label>
    <input type="password" name="password" required>

    <button class="btn btn-green">Guardar</button>
</form>
@endsection
