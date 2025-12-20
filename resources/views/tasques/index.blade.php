@extends('layouts.app')

@section('content')
<br>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

@auth
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('tasques.create') }}" class="btn btn-green">Afegir tasca</a>
    @endif
@endauth

<table>
    <thead>
        <tr>
            <th>Títol</th>
            <th>Descripció</th>
            <th>Creada</th>
            <th>Finalització</th>
            <th>Responsable</th>
            <th>Prioritat</th>
            <th>Estat</th>
            @auth
                @if(auth()->user()->role === 'admin')
                    <th>Accions</th>
                @endif
            @endauth
        </tr>
    </thead>
    <tbody>
        @foreach($tasques as $tasca)
        <tr>
            <td>{{ $tasca->titol }}</td>
            <td>{{ $tasca->descripcio }}</td>
            <td>{{ $tasca->created_at->format('d/m/Y') }}</td>
            <td>
                {{ $tasca->data_finalitzacio ? $tasca->data_finalitzacio->format('d/m/Y') : '—' }}

            </td>
            <td>{{ $tasca->usuari->name }}</td>
            <td>{{ $tasca->prioritat->nom }} ({{ $tasca->prioritat->color }})</td>
            <td>{{ $tasca->estat->nom }}</td>
            @auth
                @if(auth()->user()->role === 'admin')
                    <td>
                        <a href="{{ route('tasques.edit', $tasca) }}" class="btn btn-blue">Editar</a>
                        <form action="{{ route('tasques.destroy', $tasca) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-red" onclick="return confirm('Segur que vols eliminar aquesta tasca?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                @endif
            @endauth
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
