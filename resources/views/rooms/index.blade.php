<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Salas') }}
        </h2>
    </x-slot>

    <div class="container" x-data="{ room: '', isEditing:false }">
        <div class="row">
            @if (session('success'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Santo guacamole!</strong> {{ session('alertMsg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            <div class="col-12 mb-4">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                      <label for="inputPassword6" class="col-form-label">Buscar sala</label>
                    </div>
                    <div class="col-auto">
                      <input type="text" id="inputSearch" class="form-control" aria-describedby="searchField">
                    </div>
                    @role('admin')
                    <div class="col-auto ms-auto">
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#new-room">Nueva sala</button>
                        <x-bootstrap.modal id="new-room" title="Sala" submit-btn-text="Guardar" form-id="room-form">
                            <form id="room-form" method="POST" x-bind:action="isEditing ? '{{url('rooms')}}/'+room.id : '{{route('rooms.store')}}'">
                                <input type="hidden" name="_method" x-bind:value="isEditing ? 'PUT' : 'POST'">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name">Nombre:</label>
                                    <input type="text" class="form-control" id="name" name="name" required x-bind:value="room.name">
                                </div>
                                <div class="form-group">
                                    <label for="name">Descripcion:</label>
                                    <textarea type="text" class="form-control" id="name" name="description" x-bind:value="room.description"></textarea>
                                </div>
                            </form>
                        </x-bootstrap.modal>
                    </div>
                    @endrole
                </div>
            </div>
            @forelse ($rooms as $room)
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title font-mono">{{$room->name}}</h5>
                    <p class="card-text">{{$room->description}}</p>
                        @role('admin')
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#new-room" x-on:click="room=@js($room); isEditing = true">Editar</a>
                            <form action="{{ route('rooms.destroy', $room) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-light" type="submit">Eliminar</a>
                            </form>
                        </div>
                        @else
                        <div class="text-right">
                            <a href="{{route('bookings')}}" class="btn text-primary fw-bold text-uppercase">Reservar</a>
                        </div>
                        @endrole
                    </div>
                </div>
            </div>
            @empty
                <div class="text-center">
                    No hay salas creadas, crea una nueva
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
