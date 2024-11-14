<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            {{ __('Reservas') }}
        </h2>
    </x-slot>

    <div class="container" x-data="{ room: '', isEditing:false }">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            @if (session('success'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Santo guacamole!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            <div class="col-12 mb-4">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                      <label for="inputPassword6" class="col-form-label">Filtrar</label>
                    </div>
                    <div class="col-auto">
                        <div class="form-group">
                            <select class="form-select" aria-label="Sala" name="room_id" required x-on:change="window.location.href = '{{url('bookings')}}/'+$event.target.value">
                                <option value="">Selecciona una sala</option>
                                @foreach ($rooms as $room)
                                <option value="{{$room->id}}" {{ $room->id==$roomId ? 'selected' : '' }}>{{$room->name}}</option>
                                @endforeach
                              </select>
                        </div>
                    </div>
                    <div class="col-auto ms-auto">
                        <button type="button" class="btn fw-bold" data-bs-toggle="modal" data-bs-target="#new-booking">Nueva reserva</button>
                        <x-bootstrap.modal id="new-booking" title="Nueva reserva" submit-btn-text="Guardar" form-id="booking-form">
                            <form id="booking-form" method="POST" action="{{route('bookings.store')}}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <div class="form-group mb-3">
                                    <label for="name">Sala:</label>
                                    <select class="form-select" aria-label="Sala" name="room_id" required>
                                        @foreach ($rooms as $room)
                                        <option value="{{$room->id}}">{{$room->name}}</option>
                                        @endforeach
                                      </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Hora:</label>
                                    <input type="datetime-local" name="start_date" class="form-control" x-bind:min="new Date().toISOString().slice(0, 16)" required>
                                </div>
                            </form>
                        </x-bootstrap.modal>
                    </div>
                </div>
            </div>
            @forelse ($bookings as $booking)
            <div class="col-sm-6 col-xl-4 mb-3">
                @include('bookings.includes.booking')
            </div>
            @empty
                <div class="text-center">
                    No hay salas creadas, crea una nueva
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
