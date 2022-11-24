@extends('layouts.app')

@section('content')
    <section class="container mx-auto">
        <h1 class="text-5xl mb-8">
            Modifica il tuo apartamento
        </h1>

        <form action="{{route('admin.apartments.update', $apartment)}}" method="post" enctype="multipart/form-data" id="form">
            @csrf
            @method('PUT')

            <div class="mb-8 title-wrapper">
                <label class="block mb-4 font-bold" for="title">Modifica il titolo *</label>
                <input type="text" placeholder="Qui va il titlodel tuo annuncio" name="title" id="title" maxlength="255" required value="{{old('title', $apartment->title)}}" 
                class="w-full px-4 py-4 rounded-xl @error('title') border border-red-700 @enderror">
                <div class="title-error"></div>

                @error('title')
                    <p class="text-red-700">
                        {{$message}}
                    </p>    
                @enderror
            </div>

            <div class="mb-8">
                <label class="block mb-4 font-bold" for="image">Copertina *</label>
                <input type="file" placeholder="Aggiungi l'immagine di " name="image" id="image" value="{{old('image', $apartment->image)}}"
                class="w-full px-4 py-4 rounded-xl @error('image') border border-red-700 @enderror">

                @error('image')
                    <p class="text-red-700">
                        {{$message}}
                    </p>    
                @enderror
                <p class="hidden text-red-700" id="image_error">
                    The image failed to upload. Max size exceed.
                </p>
            </div>

            <div class="mb-8">
                <label class="block mb-4 font-bold" for="images">Aggiungi Foto alla galleria</label>
                <input type="file" multiple placeholder="Aggiungi qui un'immagine" name="images[]" id="images" value="{{old('images', $apartment->images)}}"
                class="w-full px-4 py-4 rounded-xl @error('images') border border-red-700 @enderror">

                @error('images.*')
                    <p class="text-red-700">
                        {{$message}}
                    </p>    
                @enderror
                <p class="hidden text-red-700" id="images_error">
                    The image failed to upload. Max size exceed.
                </p>
            </div>

            <div class="flex justify-between mb-8">

                <div class="meters-wrapper">
                    <label class="block mb-4 font-bold" for="meters">M. quadrati *</label>
                    <input type="number" min="0" max="65535" placeholder="Quante stanze ha il tuo immobile?" name="meters" id="meters" required value="{{old('meters', $apartment->meters)}}"
                    class="w-full px-4 py-4 rounded-xl @error('meters') border border-red-700 @enderror">
                    <div class="meters-error"></div>

                    @error('meters')
                        <p class="text-red-700">
                            {{$message}}
                        </p>    
                    @enderror
                </div>
                <div class="rooms-wrapper">
                    <label class="block mb-4 font-bold" for="rooms">N. Stanze *</label>
                    <input type="number" min="1" max="255" required placeholder="Quante stanze ha il tuo immobile?" name="rooms_number" id="rooms" required value="{{old('rooms_number', $apartment->rooms_number)}}"
                    class="w-full px-4 py-4 rounded-xl @error('rooms_number') border border-red-700 @enderror">
                    <div class="rooms-error"></div>
                    
                    @error('rooms_number')
                        <p class="text-red-700">
                            {{$message}}
                        </p>    
                    @enderror
                </div>

                <div class="beds-wrapper">
                    <label class="block mb-4 font-bold" for="beds">N. Posti letto *</label>
                    <input type="number" min="1" max="255" placeholder="Quante camere ha il tuo immobile?" name="beds_number" id="beds" required value="{{old('beds_number', $apartment->beds_number)}}"
                    class="w-full px-4 py-4 rounded-xl @error('beds_number') border border-red-700 @enderror">
                    <div class="beds-error"></div>
                    
                    @error('beds_number')
                        <p class="text-red-700">
                            {{$message}}
                        </p>    
                    @enderror
                </div>

                <div class="baths-wrapper">
                    <label class="block mb-4 font-bold" for="baths">N. Bagni *</label>
                    <input type="number" min="0" max="255" placeholder="Quanti bagni ha il tuo immobile?" name="bath_number" id="baths" required value="{{old('bath_number', $apartment->bath_number)}}"
                    class="w-full px-4 py-4 rounded-xl @error('rooms_number') border border-red-700 @enderror">
                    <div class="baths-error"></div>
                    
                    @error('bath_number')
                        <p class="text-red-700">
                            {{$message}}
                        </p>    
                    @enderror
                </div>


            </div>

            <div class="price-wrapper">
                <label class="block mb-4 font-bold" for="price">Prezzo *</label>
                <input type="number" placeholder="Costo a notte" name="price" min="0" name="price" id="price" required value="{{old('price', $apartment->price)}}"
                class="w-full px-4 py-4 rounded-xl @error('price') border border-red-700 @enderror">
                <div class="price-error"></div>
                
                @error('price')
                    <p class="text-red-700">
                        {{$message}}
                    </p>    
                @enderror
            </div>

            @php
            $key = env('TOMTOM_API_KEY');                
            @endphp                
            <search-input-component api-key="{{ $key }}"></search-input-component>
            @error('address')
                <p class="text-red-700">
                    {{$message}}
                </p>
            @enderror

            <div class="flex flex-col gap-2 mb-4">

                <label class="mr-2 font-bold">Visibilità *</label>
                <div>
                    <input class="p-2" @if($apartment->visible == true) checked @endif type="radio" name="visible" id="visible" value="true">                    
                    <label class="mr-2" @checked(true) for="visible">Visibile</label>
                </div>

                <div>
                    <input class="p-2" @if($apartment->visible == false) checked @endif type="radio" name="visible" id="hidden" value="false">                    
                    <label class="mr-2" for="hidden">Nascosto</label>
                </div>
                
                @error('visible')
                    <p class="text-red-700">
                        {{$message}}
                    </p>    
                @enderror
            </div>

            <div class="flex flex-col gap-2 mb-4">
                <label class="mr-2 font-bold">Servizi</label>
                    <ul>
                        @foreach ($services as $service)
                            <li>                                
                                <input @if(in_array($service->id, old('services', $apartment->services->pluck('id')->all()))) checked @endif class="p-2" type="checkbox" name="services[]" id="{{$service->name}}" value="{{$service->id}}">
                                <label class="mr-2" for="{{$service->name}}">{{$service->name}}</label>
                            </li>
                        @endforeach
                    </ul>
                    @error('services.*')
                        <p  class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
            </div>
            <input class="cursor-pointer w-full py-4 rounded-xl my-8 hover:bg-orange-500  bg-orange-400 text-white" type="submit" id="submit" value="Modifica Appartamento">
        </form>
    </section>
@endsection