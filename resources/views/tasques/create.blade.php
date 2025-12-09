@extends('layouts.app')

@section('content')
<h1 class="title">Afegir tasca</h1>

<form action="{{ route('tasques.store') }}" method="POST">
    @csrf

    <label>Títol</label>
    <input type="text" name="titol" required>

    <label>Descripció</label>
    <textarea name="descripcio"></textarea>

    <label>Responsable</label>
    <select name="usuari_id" required>
        @foreach($usuaris as $usuari)
            <option value="{{ $usuari->id }}">{{ $usuari->nom }}</option>
        @endforeach
    </select>

    <label>Prioritat</label>
    <select name="prioritat_id" required>
        @foreach($prioritats as $prioritat)
            <option value="{{ $prioritat->id }}">{{ $prioritat->nom }} ({{ $prioritat->color }})</option>
        @endforeach
    </select>

    <label>Estat</label>
    <select name="estat_id" required>
        @foreach($estats as $estat)
            <option value="{{ $estat->id }}">{{ $estat->nom }}</option>
        @endforeach
    </select>

    <button class="btn btn-green">Guardar</button>
</form>
@endsection
