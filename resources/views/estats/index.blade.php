@extends('layouts.app')

@section('content')
<h1 class="title">Estats</h1>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

@auth
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('estats.create') }}" class="btn btn-green">Afegir estat</a>
    @endif
@endauth

<table>
    <thead>
        <tr>
            <th>Nom</th>
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
            <td>{{ $estat->nom }}</td>
            @auth
                @if(auth()->user()->role === 'admin')
                    <td>
                        <a href="{{ route('estats.edit', $estat) }}" class="btn btn-blue">Editar</a>
                        <form action="{{ route('estats.destroy', $estat) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
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
