@extends('layouts.app')

@section('content')
<h1 class="title">Llista de prioritats</h1>

<a href="{{ route('prioritats.create') }}" class="btn btn-green">Afegir prioritat</a>

{{-- Botó “Afegir” només per admin --}}
@if(auth()->check() && auth()->user()->role === 'admin')
    <a href="{{ route('prioritats.create') }}" class="btn btn-green">Afegir prioritat</a>
@endif

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

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
            <td>{{ $prioritat->color }}</td>
            <td>
                <a href="{{ route('prioritats.edit', $prioritat) }}" class="btn btn-blue">Editar</a>
                <form action="{{ route('prioritats.destroy', $prioritat) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-red">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
