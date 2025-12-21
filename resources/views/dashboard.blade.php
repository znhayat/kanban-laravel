@extends('layouts.app')

@section('content')

{{-- 
    Creo el contenidor principal del kanban.
    Uso grid de Tailwind pk així puc fer 3 columnes a desktop
    i 1 sola columna a mòbil sense complicar-me.
--}}
<div class="kanban grid grid-cols-1 md:grid-cols-3 gap-6 px-4 py-6">

    <!-- ================= COLUMNA TODO ================= -->

    {{-- 
        Agafo l’estat "ToDo" directament de la BD.
        Ho faig aho pk després necessito el seu id
        per poder canviar l’estat quan arrossego una tasca.
    --}}
    @php $estatToDo = \App\Models\Estat::where('nom','ToDo')->first(); @endphp

    {{-- 
        Aquesta és la columna ToDo.
        Li poso data-estat-id pk el JS sap quin estat li toca
        quan deixo anar una targeta.
    --}}
    <div class="column bg-gray-50 rounded-lg p-4 shadow"
         data-estat-id="{{ $estatToDo ? $estatToDo->id : '' }}">

        {{-- Títol de la columna --}}
        <h2 class="text-xl font-bold text-blue-600 mb-4">ToDo</h2>

        {{-- Recorro totes les tasques ToDo --}}
        @foreach($todo as $t)

            {{-- 
                Cada tasca és una card.
                draggable="true" pk la pugui arrossegar.
                data-id pk després el JS sàpiga quina tasca és.
            --}}
            <div class="card relative bg-white rounded-lg shadow p-4 mb-4 flex flex-col justify-between"
                 draggable="true"
                 data-id="{{ $t->id }}">

                <!-- Cercle de prioritat a baix a la dreta -->

                {{-- 
                    Aquest span és el cercle de prioritat.
                    Uso style inline pk el color ve de la BD
                    i Tailwind NO pot gestionar colors dinàmics.
                    
                    No dona error pk Blade ja resol {{ }} abans
                    d’enviar l’HTML al navegador.
                --}}
                <span class="absolute w-4 h-4 rounded-full"
                      style="background-color: {{ $t->prioritat->color }}; bottom: 8px; right: 8px;"
                      title="Prioritat: {{ $t->prioritat->nom }}"></span>

                <!-- Contingut principal de la tasca -->
                <div>
                    <h3 class="font-semibold text-gray-800 mb-1">
                        {{ $t->titol }}
                    </h3>

                    <p class="text-sm text-gray-600">
                        {{ $t->descripcio }}
                    </p>
                </div>

                <!-- Footer amb info extra -->
                <div class="mt-4 pt-2 border-t border-gray-200 text-xs text-gray-700 space-y-1">
                    <p>
                        <span class="font-medium">Responsable:</span>
                        {{ $t->usuari->name }}
                    </p>

                    <p>
                        <span class="font-medium">Creada:</span>
                        {{ $t->created_at->format('d/m/Y') }}
                    </p>

                    <p>
                        <span class="font-medium">Finalització:</span>
                        {{ $t->data_finalitzacio ? $t->data_finalitzacio->format('d/m/Y') : '—' }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ================= COLUMNA DOING ================= -->

    {{-- Mateixa lògica q ToDo però amb l’estat Doing --}}
    @php $estatDoing = \App\Models\Estat::where('nom','Doing')->first(); @endphp

    <div class="column bg-gray-50 rounded-lg p-4 shadow"
         data-estat-id="{{ $estatDoing ? $estatDoing->id : '' }}">

        <h2 class="text-xl font-bold text-yellow-600 mb-4">Doing</h2>

        @foreach($doing as $t)
            <div class="card relative bg-white rounded-lg shadow p-4 mb-4 flex flex-col justify-between"
                 draggable="true"
                 data-id="{{ $t->id }}">

                {{-- Cercle de prioritat amb color dinàmic --}}
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

    {{-- Última columna amb l’estat Done --}}
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

    // Desa la card q estic arrossegant
    let draggedCard = null;

    // Quan començo a arrossegar, guardo la card
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('dragstart', () => { 
            draggedCard = card; 
        });
    });

    // Preparo les columnes per acceptar el drop
    document.querySelectorAll('.column').forEach(column => {

        // Necessari pk el drop funcioni
        column.addEventListener('dragover', e => e.preventDefault());

        // Quan deixo anar la card
        column.addEventListener('drop', e => {
            e.preventDefault();

            if (draggedCard) {

                // Mou la card visualment
                column.appendChild(draggedCard);

                // Agafo la tasca i el nou estat
                let taskId = draggedCard.dataset.id;
                let estatId = column.dataset.estatId;

                // Envio la petició per actualitzar l’estat a la BD
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

<!-- 
    Botó flotant per afegir tasques.
    El faig rodó pk sigui més modern i visible.
    El poso fixed pk sempre estigui a baix a la dreta.
-->
<a href="{{ route('tasques.create') }}"
   class="btn-add-task"
   title="Afegir tasca">
    +
</a>

@endsection
