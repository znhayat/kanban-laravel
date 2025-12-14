@extends('layouts.app')

@section('content')
<h1 class="title">Afegir prioritat</h1>

<form action="{{ route('prioritats.store') }}" method="POST">
    @csrf
    <label>Nom</label>
    <input type="text" name="nom" required>

    <label>Color</label>
    <input type="color" name="color" value="#888888">

    <button class="btn btn-green">Guardar</button>
</form>
@endsection
