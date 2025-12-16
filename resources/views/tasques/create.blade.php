@extends('layouts.app')

@section('content')
<h1 class="title">Afegir tasca</h1>

<form action="{{ route('tasques.store') }}" method="POST">
    @csrf

    <label>Títol</label>
    <input type="text" name="titol" value="{{ old('titol') }}" required>
    @error('titol') <div class="alert-error">{{ $message }}</div> @enderror

    <label>Descripció</label>
    <textarea name="descripcio">{{ old('descripcio') }}</textarea>
    @error('descripcio') <div class="alert-error">{{ $message }}</div> @enderror

    <label>Data de finalització</label>
    <input type="date" name="data_finalitzacio" value="{{ old('data_finalitzacio') }}">
    @error('data_finalitzacio') <div class="alert-error">{{ $message }}</div> @enderror

    <label>Responsable</label>
    <select name="usuari_id" required>
        @foreach($usuaris as $usuari)
            <option value="{{ $usuari->id }}" @selected(old('usuari_id') == $usuari->id)>
                {{ $usuari->name }}
            </option>
        @endforeach
    </select>
    @error('usuari_id') <div class="alert-error">{{ $message }}</div> @enderror

    <label>Prioritat</label>
    <select name="prioritat_id" required>
        @foreach($prioritats as $prioritat)
            <option value="{{ $prioritat->id }}" @selected(old('prioritat_id') == $prioritat->id)>
                {{ $prioritat->nom }} ({{ $prioritat->color }})
            </option>
        @endforeach
    </select>
    @error('prioritat_id') <div class="alert-error">{{ $message }}</div> @enderror

    <label>Estat</label>
    <select name="estat_id" required>
        @foreach($estats as $estat)
            <option value="{{ $estat->id }}" @selected(old('estat_id') == $estat->id)>
                {{ $estat->nom }}
            </option>
        @endforeach
    </select>
    @error('estat_id') <div class="alert-error">{{ $message }}</div> @enderror

    <button class="btn btn-green">Guardar</button>
</form>

@endsection
