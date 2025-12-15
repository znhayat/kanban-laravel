@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <div class="card">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <label for="name">Nom</label>
            <input id="name" name="name" type="text" value="{{ auth()->user()->name }}">

            <label for="email">Correu</label>
            <input id="email" name="email" type="email" value="{{ auth()->user()->email }}">

            <button type="submit" class="btn btn-green">Guardar canvis</button>
        </form>
        </div>
    </div>
</div>
@endsection
