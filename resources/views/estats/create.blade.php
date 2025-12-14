@extends('layouts.app')

@section('content')
<h1 class="title">Afegir estat</h1>

<form action="{{ route('estats.store') }}" method="POST">
    @csrf
    <label>Nom</label>
    <input type="text" name="nom" required>
    <button class="btn btn-green">Guardar</button>
</form>
@endsection
