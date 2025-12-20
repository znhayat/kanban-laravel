@extends('layouts.app')

@section('content')

<div class="kanban grid grid-cols-1 md:grid-cols-3 gap-6 px-4 py-6">

    <!-- ================= COLUMNA TODO ================= -->
    @php $estatToDo = \App\Models\Estat::where('nom','ToDo')->first(); @endphp
    <div class="column bg-gray-50 rounded-lg p-4 shadow"
         data-estat-id="{{ $estatToDo ? $estatToDo->id : '' }}">

        <h2 class="text-xl font-bold text-blue-600 mb-4">ToDo</h2>

        @foreach($todo as $t)
            <div class="card relative bg-white rounded-lg shadow p-4 mb-4 flex flex-col justify-between"
                 draggable="true"
                 data-id="{{ $t->id }}">

                <!-- Cercle de prioritat a baix a la dreta -->
                <span class="absolute w-4 h-4 rounded-full"
                      style="background-color: {{ $t->prioritat->color }}; bottom: 8px; right: 8px;"
                      title="Prioritat: {{ $t->prioritat->nom }}"></span>

                <!-- Contingut principal -->
                <div>
                    <h3 class="font-semibold text-gray-800 mb-1">{{ $t->titol }}</h3>
                    <p class="text-sm text-gray-600">{{ $t->descripcio }}</p>
                </div>

                <!-- Footer amb info addicional -->
                <div class="mt-4 pt-2 border-t border-gray-200 text-xs text-gray-700 space-y-1">
                    <p><span class="font-medium">Responsable:</span> {{ $t->usuari->name }}</p>
                    <p><span class="font-medium">Creada:</span> {{ $t->created_at->format('d/m/Y') }}</p>
                    <p><span class="font-medium">Finalització:</span>
                        {{ $t->data_finalitzacio ? $t->data_finalitzacio->format('d/m/Y') : '—' }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ================= COLUMNA DOING ================= -->
    @php $estatDoing = \App\Models\Estat::where('nom','Doing')->first(); @endphp
    <div class="column bg-gray-50 rounded-lg p-4 shadow"
         data-estat-id="{{ $estatDoing ? $estatDoing->id : '' }}">

        <h2 class="text-xl font-bold text-yellow-600 mb-4">Doing</h2>

        @foreach($doing as $t)
            <div class="card relative bg-white rounded-lg shadow p-4 mb-4 flex flex-col justify-between"
                 draggable="true"
                 data-id="{{ $t->id }}">

                <span class="absolute w-4 h-4 rounded-full"
                      style="background-color: {{ $t->prioritat->color }}; bottom: 8px; right: 8px;"
                      title="Prioritat: {{ $t->prioritat->nom }}"></span>

                <div>
                    <h3 class="font-semibold text-gray-800 mb-1">{{ $t->titol }}</h3>
                    <p class="text-sm text-gray-600">{{ $t->descripcio }}</p>
                </div>

                <div class="mt-4 pt-2 border-t border-gray-200 text-xs text-gray-700 space-y-1">
                    <p><span class="font-medium">Responsable:</span> {{ $t->usuari->name }}</p>
                    <p><span class="font-medium">Creada:</span> {{ $t->created_at->format('d/m/Y') }}</p>
                    <p><span class="font-medium">Finalització:</span>
                        {{ $t->data_finalitzacio ? $t->data_finalitzacio->format('d/m/Y') : '—' }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ================= COLUMNA DONE ================= -->
    @php $estatDone = \App\Models\Estat::where('nom','Done')->first(); @endphp
    <div class="column bg-gray-50 rounded-lg p-4 shadow"
         data-estat-id="{{ $estatDone ? $estatDone->id : '' }}">

        <h2 class="text-xl font-bold text-green-600 mb-4">Done</h2>

        @foreach($done as $t)
            <div class="card relative bg-white rounded-lg shadow p-4 mb-4 flex flex-col justify-between"
                 draggable="true"
                 data-id="{{ $t->id }}">

                <span class="absolute w-4 h-4 rounded-full"
                      style="background-color: {{ $t->prioritat->color }}; bottom: 8px; right: 8px;"
                      title="Prioritat: {{ $t->prioritat->nom }}"></span>

                <div>
                    <h3 class="font-semibold text-gray-800 mb-1">{{ $t->titol }}</h3>
                    <p class="text-sm text-gray-600">{{ $t->descripcio }}</p>
                </div>

                <div class="mt-4 pt-2 border-t border-gray-200 text-xs text-gray-700 space-y-1">
                    <p><span class="font-medium">Responsable:</span> {{ $t->usuari->name }}</p>
                    <p><span class="font-medium">Creada:</span> {{ $t->created_at->format('d/m/Y') }}</p>
                    <p><span class="font-medium">Finalització:</span>
                        {{ $t->data_finalitzacio ? $t->data_finalitzacio->format('d/m/Y') : '—' }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    // Guarda la targeta que s'està arrossegant
    let draggedCard = null;

    // Assigna l'event de dragstart a cada targeta
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('dragstart', () => { 
            draggedCard = card; 
        });
    });

    // Configura les columnes per permetre el drop
    document.querySelectorAll('.column').forEach(column => {

        // Permet que la targeta es pugui deixar anar
        column.addEventListener('dragover', e => e.preventDefault());

        // Quan es deixa anar la targeta
        column.addEventListener('drop', e => {
            e.preventDefault();

            if (draggedCard) {

                // Mou visualment la targeta a la nova columna
                column.appendChild(draggedCard);

                // Obté l'ID de la tasca i el nou estat
                let taskId = draggedCard.dataset.id;
                let estatId = column.dataset.estatId;

                // Envia la petició AJAX per actualitzar l'estat a la BD
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
