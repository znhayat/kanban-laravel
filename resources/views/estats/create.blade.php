@extends('layouts.app')

@section('content')
<div class="form-center">
    <form action="{{ route('estats.store') }}" method="POST">
        @csrf
        {{-- Token necessari perquè Laravel accepti el formulari --}}

        <label>Nom</label>
        <input type="text" name="nom" value="{{ old('nom') }}" required>

        {{-- Si hi ha errors de validació en el camp "nom", es mostren aquí --}}
        @error('nom')
            <div class="alert-error">{{ $message }}</div>
        @enderror

        <button class="btn btn-green">Guardar</button>
    </form>
</div>
@endsection
