<div class="card">
    <div class="card-body">
        <h5 class="card-title font-mono">{{$booking->user->name}}</h5>
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