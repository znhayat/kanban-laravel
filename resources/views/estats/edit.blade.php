@extends('layouts.app')
@section('content')
<h1 class="title">Llista d'estats</h1>
<a href="{{ route('estats.create') }}" class="btn btn-green">Afegir estat</a>
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($estats as $estat)
        <tr>
            <td>{{ $estat->nom }}</td>
            <td>
                <a href="{{ route('estats.edit', $estat) }}" class="btn btn-blue">Editar</a>
                <form action="{{ route('estats.destroy', $estat) }}" method="POST" style="display:inline;">
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