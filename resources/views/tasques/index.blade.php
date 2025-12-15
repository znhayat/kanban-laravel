@extends('layouts.app')

@section('content')
<h1 class="title">Tasques</h1>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('tasques.create') }}" class="btn btn-green">Afegir tasca</a>

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
            <td>{{ $tasca->usuari->name }}</td>
            <td>{{ $tasca->prioritat->nom }} ({{ $tasca->prioritat->color }})</td>
            <td>{{ $tasca->estat->nom }}</td>
            <td>
                <a href="{{ route('tasques.edit', $tasca) }}" class="btn btn-blue">Editar</a>
                <form action="{{ route('tasques.destroy', $tasca) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-red" onclick="return confirm('Segur que vols eliminar aquesta tasca?')">
                        Eliminar
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
