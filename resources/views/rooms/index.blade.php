<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Salas') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            @foreach ($rooms as $room)
            <div class="col-sm-6 mb-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{$room->name}}</h5>
                  <p class="card-text">{{$room->description}}</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
