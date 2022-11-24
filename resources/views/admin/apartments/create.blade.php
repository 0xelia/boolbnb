@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="mb-3">
            <a href="{{ redirect()->back()->getTargetUrl() }}">Torna indietro</a>
        </div>
        <div>
            <form action="{{ route('admin.apartments.store') }}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                <div class="flex flex-col gap-2 mb-4 title-wrapper">
                    <label class="mr-2 font-bold" for="title">Titolo *</label>
                    <input class="p-2 flex-grow" type="text" name="title" maxlength="255" id="title" placeholder="Inserisci un titolo" value="{{ old('title') }}" required>
                    <div class="title-error"></div>
                    
                    @error('title')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 mb-4 rooms-wrapper">
                    <label class="mr-2 font-bold" for="rooms">Numero camere *</label>
                    <input class="p-2 flex-grow" type="number" min="1" max="255" name="rooms_number" id="rooms" placeholder="Inserisci numero delle camere" value="{{ old('rooms_number') }}" required>
                    <div class="rooms-error"></div>
                    
                    @error('rooms_number')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 mb-4 beds-wrapper">
                    <label class="mr-2 font-bold" for="beds">Numero letti *</label>
                    <input class="p-2 flex-grow" type="number" min="1" max="255" name="beds_number" id="beds" placeholder="Inserisci numero dei letti" value="{{ old('beds_number') }}" required>
                    <div class="beds-error"></div>
                    
                    @error('beds_number')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 mb-4 baths-wrapper">
                    <label class="mr-2 font-bold" for="baths">Numero bagni *</label>
                    <input class="p-2 flex-grow" type="number" min="0" max="255" name="bath_number" id="baths" placeholder="Inserisci numero dei bagni" value="{{ old('bath_number') }}" required>
                    <div class="baths-error"></div>
                    
                    @error('bath_number')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 mb-4 meters-wrapper">
                    <label class="mr-2 font-bold" for="meters">Metri quadri *</label>
                    <input class="p-2 flex-grow" type="number" min="0" max="65535" name="meters" id="meters" placeholder="Inserisci metri quadri" value="{{ old('meters') }}" required>
                    <div class="meters-error"></div>
                    
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
                    <label class="mr-2 font-bold">Sponsorizzazione</label>
                    <ul>
                        @foreach ($sponsors as $sponsor)
                            <li>
                                <input class="p-2" type="radio" name="sponsors[]" @if( in_array($sponsor->id, old('sponsor', []))) checked @endif id="{{$sponsor->plane}}" value="{{$sponsor->id}}">
                                <label class="mr-2" for="{{$sponsor->plane}}">{{$sponsor->plane}}</label>
                            </li>
                        @endforeach
                    </ul>
                    @error('sponsors.*')
                        <p  class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-2 mb-4 price-wrapper">
                    <label class="mr-2 font-bold" for="price">Prezzo *</label>
                    <input class="p-2 flex-grow" type="number" min="0" name="price" id="price" placeholder="Inserisci il prezzo" value="{{ old('price') }}" required>
                    <div class="price-error"></div>
                    
                    @error('price')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="image">Aggiungi immagine di copertina *</label>
                    <input type="file" name="image" id="image" required>
                    @error('image')
                        <p class="text-red-700">
                            {{$message}}                            
                        </p>
                    @enderror
                    <p class="hidden text-red-700" id="image_error">
                        The image failed to upload. Max size exceed.
                    </p>
                </div>
                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="images">Aggiungi immagine/i alla galleria</label>
                    <input type="file" name="images[]" id="images" multiple>
                    @error('images[]')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                    <p class="hidden text-red-700" id="images_error">
                        The image failed to upload. Max size exceed.
                    </p>
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
                    <div class="visibility-error"></div>

                    @error('visible')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <input class="p-2 border-2 rounded-lg bg-transparent cursor-pointer" type="submit" id="submit" value="Salva">
            </form>
            <div><strong>*</strong> indica un campo obbligatorio</div>
        </div>
    </div>
@endsection