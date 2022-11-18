@extends('layouts.app')

@section('content')
    <div class="container mx-auto flex items-center mb-3">
        <div>
            <h2 class="text-3xl">Appartamenti</h1>
        </div>
        <div class="ml-auto">
            <a class="p-2 border-2 rounded-lg" href="{{ route('admin.apartments.create') }}">Aggiungi appartamento</a>
        </div>
    </div>
    <div class="container mx-auto">
        <ul class="grid grid-cols-4 gap-4">
            @foreach ($apartments as $apartment)
                <a href="{{ route('admin.apartments.show', $apartment) }}">
                    <li>
                        <figure>
                            <img class="rounded-lg mb-3" src="{{ $apartment->image }}" alt="">
                        </figure>
                        <h3 class="font-bold capitalize">
                            {{ $apartment->title }}
                        </h3>
                    </li>
                </a>
            @endforeach
        </ul>
        
        {{ $apartments->links() }}
    </div>
@endsection