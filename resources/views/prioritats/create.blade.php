@extends('layouts.app')

@section('content')
<h1 class="title">Afegir prioritat</h1>

<form action="{{ route('prioritats.store') }}" method="POST">
    @csrf
    <label>Nom</label>
    <input type="text" name="nom" required>

    <label>Color</label>
    <input type="text" name="color" required>

    <button class="btn btn-green">Guardar</button>
</form>
@endsection
