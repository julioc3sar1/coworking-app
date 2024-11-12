<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Salas') }}
        </h2>
    </x-slot>

    <div class="container">
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
                    <div class="col-auto ms-auto">
                        <button class="btn">Nueva sala</button>
                    </div>
                </div>
            </div>
            @foreach ($rooms as $room)
            <div class="col-sm-6 mb-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{$room->name}}</h5>
                  <p class="card-text">{{$room->description}}</p>
                    @role('admin')
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-warning">Editar</a>
                        <form action="{{ route('rooms.destroy', $room) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-light" type="submit">Eliminar</a>
                        </form>   
                    </div>
        
                    @else
                    <a href="#" class="btn btn-primary">Reservar</a>
                    @endrole
                </div>
              </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
