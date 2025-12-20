@extends('layouts.app')

@section('content')
<br>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

@auth
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('prioritats.create') }}" class="btn btn-green">Afegir prioritat</a>
    @endif
@endauth

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Color</th>
            @auth
                @if(auth()->user()->role === 'admin')
                    <th>Accions</th>
                @endif
            @endauth
        </tr>
    </thead>
    <tbody>
        @foreach($prioritats as $prioritat)
        <tr>
            <td>{{ $prioritat->nom }}</td>
            <td>
                {{-- Aquesta línia pot donar error si $prioritat->color és null o no existeix,
                     perquè llavors no es pot aplicar un color vàlid al CSS.
                     També es posa l’estil aquí perquè el color ve de la base de dades
                     i s’ha d’aplicar de manera dinàmica a cada prioritat. --}}
                <span class="color-circle" style="background-color: {{ $prioritat->color }}"></span>
            </td>
            @auth
                @if(auth()->user()->role === 'admin')
                    <td>
                        <a href="{{ route('prioritats.edit', $prioritat) }}" class="btn btn-blue">Editar</a>
                        <form action="{{ route('prioritats.destroy', $prioritat) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-red" onclick="return confirm('Segur que vols eliminar aquesta prioritat?')">
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
