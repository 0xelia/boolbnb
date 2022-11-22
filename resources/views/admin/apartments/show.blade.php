@extends('layouts.app')

@section('content')

    <section class="container mx-auto">

        <h1 class="text-5xl font-bold mb-8">
            {{$apartment->title}}
        </h1>
        
        <div class="grid grid-cols-2 pr-4">

            <figure class="overflow-hidden rounded-xl w-full">
                <img class="w-full" src="{{ $apartment->pic_path }}" alt="">
            </figure>
            <ul class="flex flex-col">
                
            </ul>
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
        <ul>
            <p class="text-2xl font-bold mb-2"> Informazioni Aggiuntive </p> 
            <li>
                Metri Quadrati: <span class="font-bold">{{$apartment->meters}}</span>
            </li>
            <li>
                Indirizzo: {{$apartment->address}}
            </li>
        </ul>

        
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