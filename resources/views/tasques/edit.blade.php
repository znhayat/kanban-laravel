@extends('layouts.app')

@section('content')
<h1 class="title">Editar tasca</h1>

<form action="{{ route('tasques.update', $tasca) }}" method="POST">
    @csrf @method('PUT')

    <label>Títol</label>
    <input type="text" name="titol" value="{{ $tasca->titol }}" required>

    <label>Descripció</label>
    <textarea name="descripcio">{{ $tasca->descripcio }}</textarea>

    <label>Responsable</label>
    <select name="usuari_id" required>
        @foreach($usuaris as $usuari)
            <option value="{{ $usuari->id }}" @selected($usuari->id == $tasca->user_id)>
                {{ $usuari->name }}
            </option>
        @endforeach
    </select>

    <label>Prioritat</label>
    <select name="prioritat_id" required>
        @foreach($prioritats as $prioritat)
            <option value="{{ $prioritat->id }}" @selected($prioritat->id == $tasca->prioritat_id)>
                {{ $prioritat->nom }} ({{ $prioritat->color }})
            </option>
        @endforeach
    </select>

    <label>Estat</label>
    <select name="estat_id" required>
        @foreach($estats as $estat)
            <option value="{{ $estat->id }}" @selected($estat->id == $tasca->estat_id)>
                {{ $estat->nom }}
            </option>
        @endforeach
    </select>

    <button class="btn btn-blue">Actualitzar</button>
</form>
@endsection
