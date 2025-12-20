@extends('layouts.app')

@section('content')
<br>

{{-- Mostra un missatge d’èxit si existeix a la sessió --}}
@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

{{-- Només els usuaris amb rol admin poden crear nous estats --}}
@auth
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('estats.create') }}" class="btn btn-green">Afegir estat</a>
    @endif
@endauth

<table>
    <thead>
        <tr>
            <th>Nom</th>

            {{-- La columna d’accions només es mostra als administradors --}}
            @auth
                @if(auth()->user()->role === 'admin')
                    <th>Accions</th>
                @endif
            @endauth
        </tr>
    </thead>

    <tbody>
        @foreach($estats as $estat)
        <tr>
            {{-- Mostra el nom de l’estat --}}
            <td>{{ $estat->nom }}</td>

            {{-- Accions disponibles només per administradors --}}
            @auth
                @if(auth()->user()->role === 'admin')
                    <td>
                        {{-- Enllaç per editar l’estat --}}
                        <a href="{{ route('estats.edit', $estat) }}" class="btn btn-blue">Editar</a>

                        {{-- Formulari per eliminar l’estat --}}
                        <form action="{{ route('estats.destroy', $estat) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')

                            {{-- Confirmació abans d’eliminar --}}
                            <button class="btn btn-red" onclick="return confirm('Segur que vols eliminar aquest estat?')">
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
