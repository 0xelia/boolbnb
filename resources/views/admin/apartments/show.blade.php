@extends('layouts.app')

@section('content')

    <section class="container mx-auto">

        <div class="mb-3">
            <a href="{{ route('admin.apartments.index') }}" class="block text-brand-500 pt-5 router-link-active"><i class="fa-chevron-left fa-solid"></i> Torna indietro</a>
        </div>

        <h1 class="text-5xl title font-bold mb-8">
            {{$apartment->title}}
        </h1>

        <div class="grid grid-cols-2 pr-4">

            <div class="flex flex-col">

                <figure class="overflow-hidden rounded-xl w-full">
                    <img class="w-full" src="{{ $apartment->pic_path }}" alt="">
                </figure>


                @if($apartment->images)

                <ul class="flex  flex-no-wrap py-4 gap-2">
                    @foreach ($apartment->images as $image)
                    <li class="gallery_pic">
                        <figure class=" cursor-pointer w-40 max-h-24 overflow-hidden rounded-xl">
                            <img class="h-full w-full object-cover object-center" src="{{$image->img_path}}" alt="">
                        </figure>
                        <div class="flex justify-center">
                            <form action="{{route('admin.images.destroy', $image)}}" method="post">
                                @csrf
                                @method('DELETE')

                                <input type="submit" value="Elimina" class="delete_btn mt-1 px-6 py-2 text-white bg-red-600 rounded-xl text-xs cursor-pointer">
                            </form>
                            </div>
                    </li>
                        @endforeach
                    </ul>
                @endif

            </div>
        </div>

        <h3 class="text-2xl font-bold mb-2">
            Informazioni:
        </h3>

        <ul class="flex gap-6 mb-8">
            <li>
                Stanze: <span class="font-bold">{{$apartment->rooms_number}}</span>
            </li>
            <li>
                Posti letto: <span class="font-bold">{{$apartment->beds_number}}</span>
            </li>
            <li>
                Bagni: <span class="font-bold">{{$apartment->bath_number}}</span>
            </li>
        </ul>
        <ul class="mb-8">
            <p class="text-2xl font-bold mb-2"> Informazioni Aggiuntive </p>
            <li>
                Metri Quadrati: <span class="font-bold">{{$apartment->meters}}</span>
            </li>
            <li>
                Indirizzo: {{$apartment->address}}
            </li>
        </ul>
        <div class="mb-8">
            <p class="text-2xl font-bold mb-2"> Servizi </p>
            <ul class="flex gap-6">
                @forelse ($apartment->services as $service)
                    <li class="font-bold">
                        {{$service->name}}
                    </li>
                @empty
                    <li class="font-bold">Nessun servizio</li>
                @endforelse
            </ul>
        </div>
        <div class="mb-8">
            <p class="text-2xl font-bold mb-2"> Sponsorizazzione </p>
            <ul class="flex gap-6">
                @forelse ($apartment->sponsors as $sponsor)
                    <li class="font-bold">
                        {{$sponsor->plan}}
                    </li>
                @empty
                    <li class="font-bold">Nessuna sponsorizzazione</li>
                @endforelse
            </ul>
        </div>
        <div class="mb-8">
            <p class="text-2xl font-bold mb-2"> Ultimi messaggi </p>
            <table class="table-auto border-separate mb-4">
                @if ( count($apartment->messages) > 0 )
                    <tr class="text-left">
                        <th>
                            Nome
                        </th>
                        <th>
                            Cognome
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Testo
                        </th>
                        <th></th>
                    </tr>
                @endif
                @forelse ($apartment->messages()->orderBy('id', 'desc')->get() as $key => $message)
                    @if ($key < 5)
                        @php
                            $text = $message->text;
                        @endphp
                        <tr class="@if($message->viewed == false) bg-red-200 @endif">
                            <td>
                                {{ $message->name }}
                            </td>
                            <td>
                                {{ $message->surname }}
                            </td>
                            <td>
                                {{ $message->email }}
                            </td>
                            <td>
                                {{ strlen($text) > 50 ? substr($text,0,50)."..." : $text }}
                            </td>
                            <td>
                                <a href="{{ route('admin.messages.show', [$apartment,$message]) }}" class="block rounded-lg bg-green-400 text-white py-2 px-4">Leggi</a>
                            </td>
                        </tr>
                    @else
                        @break
                    @endif
                @empty
                    <tr>
                        <td colspan="5">
                            Nessun messaggio
                        </td>
                    </tr>
                @endforelse
            </table>
            @if (count($apartment->messages) > 5)
                <a href="{{ route('admin.messages.index', $apartment->id) }}" class="rounded-lg bg-blue-400 text-white py-2 px-4">Tutti i messaggi...</a>
            @endif
        </div>
        <div class="flex gap-2">

            <a href="{{route('admin.apartments.edit', $apartment)}}" class="flex-grow">
                <input class="w-full  cursor-pointer py-4 px-8 rounded-xl my-8 hover:bg-orange-500  bg-orange-400 text-white" type="button" value="Modifica Appartamento">
            </a>
            <form action="{{route('admin.apartments.destroy', $apartment)}}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" value=" Elimina" class="cursor-pointer py-4 px-8 rounded-xl my-8 hover:bg-red-500  bg-red-400 text-white">
            </form>
        </div>
    </section>

@endsection