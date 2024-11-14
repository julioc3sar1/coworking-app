<div class="card border-light">
    <div class="card-body">
    <h5 class="card-title font-mono">{{$room->name}}</h5>
    <p class="card-text text-truncate">{{$room->description}}</p>
        @role('admin')
        <div class="d-flex gap-2 justify-content-end">
            <button type="button" class="btn text-warning fw-bold" data-bs-toggle="modal" data-bs-target="#new-room" x-on:click="room=@js($room); isEditing = true">Editar</a>
            <form action="{{ route('rooms.destroy', $room) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn fw-bold" type="submit">Eliminar</a>
            </form>
        </div>
        @else
        <div class="text-right">
            <a href="{{route('bookings')}}" class="btn text-primary fw-bold text-uppercase">Reservar</a>
        </div>
        @endrole
    </div>
</div>