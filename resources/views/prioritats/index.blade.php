@extends('layouts.app')

@section('content')
<br></br>

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
                <!-- 👇 Cercle de color -->
                <span style="display:inline-block; width:20px; height:20px; border-radius:50%; background-color: {{ $prioritat->color }}; border:1px solid #ccc;"></span>
                {{ $prioritat->color }}
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
