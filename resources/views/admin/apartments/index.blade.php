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
            <div class="flex-col">
                <li class="flex h-full flex-col relative">
                    <figure class="static overflow-hidden flex-grow rounded-xl">
                        <a href="{{ route('admin.apartments.show', $apartment) }}">
                            <img class="w-full h-full object-cover object-center" src="{{ $apartment->pic_path }}" alt="">
                        </a>
                        <promotion-component class="absolute bottom-6 right-3 " :apartment="{{$apartment}}"/>
                    </figure>
                    <a href="{{ route('admin.apartments.show', $apartment) }}">
                        <h3 class="font-bold capitalize">
                            {{ $apartment->title }}
                        </h3>
                    </a>
                    @php
                        $unviewedMessages = 0;
                    @endphp
                    @foreach ($apartment->messages as $message)
                        @if ($message->viewed == false)
                            @php
                                $unviewedMessages++;
                            @endphp
                        @endif
                    @endforeach
                    @if ($unviewedMessages > 0)
                        <div class="absolute notification flex items-center justify-center  rounded-full h-6 w-6 text-center text-xs bg-red-500 text-white">
                            <span> {{ $unviewedMessages }} </span>
                        </div>
                    @endif
                </li>     
            </div>
            @endforeach
        </ul>

        {{ $apartments->links() }}
    </div>
@endsection

