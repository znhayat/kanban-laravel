@extends('layouts.app')

@section('content')
<div class="kanban">
    <!--Columna ToDo -->
    <div class="column" data-estat-id="{{ \App\Models\Estat::where('nom','ToDo')->first()->id }}">
        <h2>ToDo</h2>
        @foreach($todo as $t)
            <div class="card" draggable="true" data-id="{{ $t->id }}">
                <strong>{{ $t->titol }}</strong>
                <p>{{ $t->descripcio }}</p>
                <small>Resp: {{ $t->usuari->name }}</small>
                <small>
                    Prioritat: {{ $t->prioritat->nom }}
                    <span class="color-circle" style="background-color: {{ $t->prioritat->color }}"></span>
                </small>
            </div>
        @endforeach
    </div>

    <!--Columna Doing -->
    <div class="column" data-estat-id="{{ \App\Models\Estat::where('nom','Doing')->first()->id }}">
        <h2>Doing</h2>
        @foreach($doing as $t)
            <div class="card" draggable="true" data-id="{{ $t->id }}">
                <strong>{{ $t->titol }}</strong>
                <p>{{ $t->descripcio }}</p>
                <small>Resp: {{ $t->usuari->name }}</small>
                <small>
                    Prioritat: {{ $t->prioritat->nom }}
                    <span class="color-circle" style="background-color: {{ $t->prioritat->color }}"></span>
                </small>
            </div>
        @endforeach
    </div>

    <!--Columna Done -->
    <div class="column" data-estat-id="{{ \App\Models\Estat::where('nom','Done')->first()->id }}">
        <h2>Done</h2>
        @foreach($done as $t)
            <div class="card" draggable="true" data-id="{{ $t->id }}">
                <strong>{{ $t->titol }}</strong>
                <p>{{ $t->descripcio }}</p>
                <small>Resp: {{ $t->usuari->name }}</small>
                <small>
                    Prioritat: {{ $t->prioritat->nom }}
                    <span class="color-circle" style="background-color: {{ $t->prioritat->color }}"></span>
                </small>
            </div>
        @endforeach
    </div>
</div>

<!--Script per gestionar el drag & drop -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    let draggedCard = null;

    // Quan comença l'arrossegament d'una targeta
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('dragstart', e => {
            draggedCard = card;
        });
    });

    // Configuració de les columnes
    document.querySelectorAll('.column').forEach(column => {
        column.addEventListener('dragover', e => {
            e.preventDefault();
        });

        column.addEventListener('drop', e => {
            e.preventDefault();
            if (draggedCard) {
                column.appendChild(draggedCard);

                let taskId = draggedCard.dataset.id;
                let estatId = column.dataset.estatId;

                // Petició AJAX per actualitzar l'estat
                fetch(`/tasques/${taskId}/update-estat`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ estat_id: estatId })
                });
            }
        });
    });
});
</script>
@endsection
