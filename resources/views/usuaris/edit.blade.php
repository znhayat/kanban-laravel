@extends('layouts.app')

@section('content')

<div class="form-center">
<form action="{{ route('usuaris.update', $usuari) }}" method="POST" class="form">
    @csrf
    @method('PUT')

    <label>Nom</label>
    <input type="text" name="nom" value="{{ $usuari->name }}" required>
    @error('nom') 
        <div class="alert-error">{{ $message }}</div> 
    @enderror

    <label>Email</label>
    <input type="email" name="email" value="{{ $usuari->email }}" required>
    @error('email') 
        <div class="alert-error">{{ $message }}</div> 
    @enderror

    <label>Contrasenya (nova)</label>
    <input type="password" name="password">
    @error('password') 
        <div class="alert-error">{{ $message }}</div> 
    @enderror

    <button class="btn btn-blue">Actualitzar</button>
</form>
</div>
@endsection
