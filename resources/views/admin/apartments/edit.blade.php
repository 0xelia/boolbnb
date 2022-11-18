@extends('layouts.app')

@section('content')
    <section class="container mx-auto">
        <h1 class="text-5xl mb-8">
            Modifica il tuo apartamento
        </h1>

        <form action="{{route('admin.apartments.update', $apartment)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-8">
                <label class="block mb-4" for="title">Modifica il titolo</label>
                <input type="text" placeholder="Qui va il titlodel tuo annuncio" name="title" id="title" value="{{old('title', $apartment->title)}}"
                class="w-full px-4 py-4 rounded-xl @error('title') border border-red-700 @enderror">

                @error('title')
                    <p class="text-red-700">
                        {{$message}}
                    </p>    
                @enderror
            </div>


            <div class="mb-8">
                <label class="block mb-4" for="image">Copertina</label>
                <input type="file" placeholder="Aggiungi l'immagine di " name="image" id="image" value="{{old('images', $apartment->images)}}"
                class="w-full px-4 py-4 rounded-xl @error('title') border border-red-700 @enderror">

                @error('images')
                    <p class="text-red-700">
                        {{$message}}
                    </p>    
                @enderror
            </div>

            <div class="mb-8">
                <label class="block mb-4" for="images">Galleria Immagini</label>
                <input type="file" multiple placeholder="Aggiungi qui un'immagine" name="images[]" id="images" value="{{old('images', $apartment->images)}}"
                class="w-full px-4 py-4 rounded-xl @error('title') border border-red-700 @enderror">

                @error('images')
                    <p class="text-red-700">
                        {{$message}}
                    </p>    
                @enderror
            </div>



            <div class="flex justify-between mb-8">

                <div class="">
                    <label class="block mb-4" for="rooms_number">N. Stanze</label>
                    <input type="number" placeholder="Quante stanze ha il tuo immobile?" name="rooms_number" id="title" value="{{old('rooms_number', $apartment->rooms_number)}}"
                    class="w-full px-4 py-4 rounded-xl @error('rooms_number') border border-red-700 @enderror">
                    
                    @error('rooms_number')
                        <p class="text-red-700">
                            {{$message}}
                        </p>    
                    @enderror
                </div>

                <div class="">
                    <label class="block mb-4" for="beds_number">N. Posti letto</label>
                    <input type="number" placeholder="Quante camere ha il tuo immobile?" name="beds_number" id="title" value="{{old('beds_number', $apartment->rooms_number)}}"
                    class="w-full px-4 py-4 rounded-xl @error('beds_number') border border-red-700 @enderror">
                    
                    @error('beds_number')
                        <p class="text-red-700">
                            {{$message}}
                        </p>    
                    @enderror
                </div>

                <div class="">
                    <label class="block mb-4" for="bath_number">N. Bagni</label>
                    <input type="number" placeholder="Quanti bagni ha il tuo immobile?" name="bath_number" id="title" value="{{old('bath_number', $apartment->bath_number)}}"
                    class="w-full px-4 py-4 rounded-xl @error('rooms_number') border border-red-700 @enderror">
                    
                    @error('bath_number')
                        <p class="text-red-700">
                            {{$message}}
                        </p>    
                    @enderror
                </div>

            </div>

            <div>
                <label class="block mb-4" for="address">Modifica il'indirizzo</label>
                <input type="text" placeholder="Qui va l'indirizzo del tu immobile" name="address" id="address" value="{{old('address', $apartment->address)}}"
                class="w-full px-4 py-4 rounded-xl @error('address') border border-red-700 @enderror">

                @error('address')
                    <p class="text-red-700">
                        {{$message}}
                    </p>    
                @enderror
            </div>

            <input class="w-full py-4 rounded-xl my-8 hover:bg-orange-500  bg-orange-400 text-white" type="submit" value="Modifica Appartamento">
        </form>
    </section>
@endsection