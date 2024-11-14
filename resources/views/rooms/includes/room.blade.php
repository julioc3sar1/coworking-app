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