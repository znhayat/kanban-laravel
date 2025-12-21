@extends('layouts.app')

@section('content')

<a href="{{ route('usuaris.create') }}" class="btn btn-green">Afegir responsable</a>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuaris as $usuari)
        <tr>
            <td>{{ $usuari->name }}</td>
            <td>{{ $usuari->email }}</td>
            <td>
                <a href="{{ route('usuaris.edit', $usuari) }}" class="btn btn-blue">Editar</a>

                <form action="{{ route('usuaris.destroy', $usuari) }}" method="POST" style="display:inline;">
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
