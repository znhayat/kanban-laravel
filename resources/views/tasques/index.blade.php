@extends('layouts.app')

@section('content')
<h1 class="title">Llista de tasques</h1>

{{-- Botó “Afegir” només per admin --}}
@if(auth()->check() && auth()->user()->role === 'admin')
    <a href="{{ route('tasques.create') }}" class="btn btn-green">Afegir tasca</a>
@endif

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Títol</th>
            <th>Descripció</th>
            <th>Responsable</th>
            <th>Prioritat</th>
            <th>Estat</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasques as $tasca)
        <tr>
            <td>{{ $tasca->titol }}</td>
            <td>{{ $tasca->descripcio }}</td>
            <td>{{ $tasca->usuari->nom }}</td>
            <td>{{ $tasca->prioritat->nom }} ({{ $tasca->prioritat->color }})</td>
            <td>{{ $tasca->estat->nom }}</td>
            <td>
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('tasques.edit', $tasca) }}" class="btn btn-blue">Editar</a>
                    <form action="{{ route('tasques.destroy', $tasca) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-red">Eliminar</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
