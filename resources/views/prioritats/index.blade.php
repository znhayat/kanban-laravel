@extends('layouts.app')

@section('content')
<h1 class="title">Prioritats</h1>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('prioritats.create') }}" class="btn btn-green">Afegir prioritat</a>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Color</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($prioritats as $prioritat)
        <tr>
            <td>{{ $prioritat->nom }}</td>
            <td>
                <span>
                    {{ $prioritat->color }}
                </span>
            </td>
            <td>
                <a href="{{ route('prioritats.edit', $prioritat) }}" class="btn btn-blue">Editar</a>
                <form action="{{ route('prioritats.destroy', $prioritat) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-red" onclick="return confirm('Segur que vols eliminar aquesta prioritat?')">
                        Eliminar
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
