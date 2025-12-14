@extends('layouts.app')

@section('content')
<h1 class="title">Kanban</h1>


<div class="kanban">
    <div class="column">
        <h2>ToDo</h2>
        @foreach($todo as $t)
            <div class="card">
                <strong>{{ $t->titol }}</strong>
                <p>{{ $t->descripcio }}</p>
                <small>Resp: {{ $t->usuari->name }}</small>
                <small>Prioritat: {{ $t->prioritat->nom }}</small>
            </div>
        @endforeach
    </div>

    <div class="column">
        <h2>Doing</h2>
        @foreach($doing as $t)
            <div class="card">
                <strong>{{ $t->titol }}</strong>
                <p>{{ $t->descripcio }}</p>
                <small>Resp: {{ $t->usuari->name }}</small>
                <small>Prioritat: {{ $t->prioritat->nom }}</small>
            </div>
        @endforeach
    </div>

    <div class="column">
        <h2>Done</h2>
        @foreach($done as $t)
            <div class="card">
                <strong>{{ $t->titol }}</strong>
                <p>{{ $t->descripcio }}</p>
                <small>Resp: {{ $t->usuari->name }}</small>
                <small>Prioritat: {{ $t->prioritat->nom }}</small>
            </div>
        @endforeach
    </div>
</div>
@endsection
