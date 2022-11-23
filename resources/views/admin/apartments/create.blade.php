@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="mb-3">
            <a href="{{ redirect()->back()->getTargetUrl() }}">Torna indietro</a>
        </div>
        <div>
            <form action="{{ route('admin.apartments.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="title">Titolo *</label>
                    <input class="p-2 flex-grow" type="text" name="title" id="title" placeholder="Inserisci un titolo" value="{{ old('title') }}" required>
                    @error('title')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="rooms">Numero camere *</label>
                    <input class="p-2 flex-grow" type="number" name="rooms_number" id="rooms" placeholder="Inserisci numero delle camere" value="{{ old('rooms_number') }}" required>
                    @error('rooms_number')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="beds">Numero letti *</label>
                    <input class="p-2 flex-grow" type="number" name="beds_number" id="beds" placeholder="Inserisci numero dei letti" value="{{ old('beds_number') }}" required>
                    @error('beds_number')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="baths">Numero bagni *</label>
                    <input class="p-2 flex-grow" type="number" name="bath_number" id="baths" placeholder="Inserisci numero dei bagni" value="{{ old('bath_number') }}" required>
                    @error('bath_number')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="meters">Metri quadri *</label>
                    <input class="p-2 flex-grow" type="number" name="meters" id="meters" placeholder="Inserisci metri quadri" value="{{ old('meters') }}" required>
                    @error('meters')
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
                <!--<div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="city">Città:</label>
                    <input class="p-2 flex-grow" type="text" name="city" id="city" placeholder="Inserisci la città" value="{{ old('city') }}">
                    @error('city')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="address">Indirizzo:</label>
                    <input class="p-2 flex-grow" type="text" name="address" id="address" placeholder="Inserisci l'indirizzo" value="{{ old('address') }}">
                    @error('address')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>-->

                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold">Servizi</label>
                    <ul>
                        @foreach ($services as $service)
                            <li>
                                <input class="p-2" type="checkbox" name="services[]" @if( in_array($service->id, old('service', []))) checked @endif id="{{$service->name}}" value="{{$service->id}}">
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

                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="price">Prezzo *</label>
                    <input class="p-2 flex-grow" type="number" name="price" id="price" placeholder="Inserisci il prezzo" value="{{ old('price') }}" required>
                    @error('price')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="image">Aggiungi immagine di copertina</label>
                    <input type="file" name="image" id="image">
                    @error('image')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="images">Aggiungi immagine/i alla galleria</label>
                    <input type="file" name="images[]" id="images" multiple>
                    @error('images[]')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold">Visibilità *</label>
                    <div>
                        <input class="p-2" type="radio" name="visible" id="visible" value="true" required>
                        <label class="mr-2" for="visible">Visibile</label>
                    </div>
                    <div>
                        <input class="p-2" type="radio" name="visible" id="hidden" value="false">
                        <label class="mr-2" for="hidden">Nascosto</label>
                    </div>
                    @error('visible')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <input class="p-2 border-2 rounded-lg bg-transparent cursor-pointer" type="submit" value="Salva">
            </form>
            <div><strong>*</strong> indica un campo obbligatorio</div>
        </div>
    </div>
@endsection