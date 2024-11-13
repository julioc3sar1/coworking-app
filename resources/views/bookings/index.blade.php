<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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
                    <strong>Santo guacamole!</strong> {{ session('alertMsg') }}
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
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#new-booking">Nueva reserva</button>
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
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$booking->user->name}}</h5>
                        <p class="card-text mb-0"><span class="fw-bold">Sala:</span> {{$booking->room->name}}</p>
                        <p class=" mb-0">
                            <span class="fw-bold">Fecha: </span>
                            {{ date('d M h:i A', strtotime($booking->start_date)) }}
                        </p>
                        <div class="mb-0 d-flex justify-content-between">
                            <div>
                                <span class="fw-bold">Status: </span>
                                <span @class(['badge rounded-pill','bg-success' => $booking->status==='accepted','bg-danger' => $booking->status==='rejected','bg-warning' => $booking->status==='pending'])>
                                    @if($booking->status === 'pending')
                                    Pendiente
                                    @elseif($booking->status === 'accepted')
                                    Aceptada
                                    @else
                                    Rechazada
                                    @endif
                                </span>
                            </div>
                            @role('admin')
                            <button class="underline" data-bs-target="#update-status-{{$loop->index}}" data-bs-toggle="modal">Cambiar status</button>
                            <x-bootstrap.modal id="update-status-{{$loop->index}}" title="Cambiar status" submit-btn-text="Guardar" form-id="status-form-{{$loop->index}}">
                                <form id="status-form-{{$loop->index}}" method="POST" action="{{route('bookings.status',$booking)}}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3">
                                        <label for="name">Status:</label>
                                        <select class="form-select" aria-label="Sala" name="status" required>
                                            <option value="pending">Pendiente</option>
                                            <option value="accepted">Aceptada</option>
                                            <option value="rejected">Rechazada</option>
                                          </select>
                                    </div>
                                </form>
                            </x-bootstrap.modal>
                            @endrole
                        </div>
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
