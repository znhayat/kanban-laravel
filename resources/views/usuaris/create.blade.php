@extends('layouts.app')

@section('content')

<div class="form-center">
<form action="{{ route('usuaris.store') }}" method="POST" class="form">
    @csrf

    <label>Nom</label>
    <input type="text" name="nom" required>
    @error('nom') 
        <div class="alert-error">{{ $message }}</div> 
    @enderror

    <label>Email</label>
    <input type="email" name="email" required>
    @error('email') 
        <div class="alert-error">{{ $message }}</div> 
    @enderror

    <label>Contrasenya</label>
    <input type="password" name="password" required>
    @error('password') 
        <div class="alert-error">{{ $message }}</div> 
    @enderror

    <button class="btn btn-green">Guardar</button>
</form>
</div>
@endsection
