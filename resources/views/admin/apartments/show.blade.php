@extends('layouts.app')

@section('content')
    
    <section class="container mx-auto">

        <h1 class="text-5xl font-bold mb-8">
            {{$apartment->title}}
        </h1>
        
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

        

        <a href="{{route('admin.apartments.edit', $apartment)}}" class="">
            <input class="w-full py-4 rounded-xl my-8 hover:bg-orange-500  bg-orange-400 text-white" type="button" value="Modifica Appartamento">
        </a>
    </section>

@endsection