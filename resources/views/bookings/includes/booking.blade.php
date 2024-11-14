<div class="card border-light">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5 class="card-title">{{$booking->user->name}}</h5>
            <div>
                <span @class(['badge rounded-pill','bg-success' => $booking->status==='accepted','bg-danger' => $booking->status==='rejected','bg-warning text-dark' => $booking->status==='pending'])>
                    @if($booking->status === 'pending')
                    Pendiente
                    @elseif($booking->status === 'accepted')
                    Aceptada
                    @else
                    Rechazada
                    @endif
                </span>
            </div>
        </div>
        <p class="card-text mb-0"><span class="fw-bold">Sala:</span> <span class="text-secondary">{{$booking->room->name}}</span></p>
        <div class="mb-0 d-flex justify-content-between pt-4">
            <p class=" mb-0 text-secondary">
                {{ date('d M h:i A', strtotime($booking->start_date)) }}
            </p>
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