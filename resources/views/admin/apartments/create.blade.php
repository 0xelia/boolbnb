@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.apartments.index') }}" class="block text-brand-500 pt-5 router-link-active"><i class="fa-chevron-left fa-solid"></i>Torna indietro</a>
        </div>


        <h1 class="text-4xl title font-bold mb-8">
            Aggiungi un appartamento
        </h1>

        <div>
            <form action="{{ route('admin.apartments.store') }}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                <div class="flex flex-col gap-2 mb-4 title-wrapper">
                    <label class="text-2xl mr-2 font-bold" for="title">Titolo *</label>
                    <input class="p-2 flex-grow" type="text" name="title" maxlength="255" id="title" placeholder="Inserisci un titolo" value="{{ old('title') }}" required>
                    <div class="title-error"></div>

                    @error('title')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="text-2xl font-bold mb-4">Informazioni: </div>
                <div class="flex-row  md:flex md:gap-6 justify-between border p-3 rounded-lg items-center mb-4">
                    <div class="flex flex-col gap-2 mb-4 rooms-wrapper">
                        <label class="mr-2 font-bold" for="rooms">Numero camere *</label>
                        <input class="p-2 flex-grow" type="number" min="1" max="255" name="rooms_number" id="rooms" placeholder="" value="{{ old('rooms_number') }}" required>
                        <div class="rooms-error"></div>

                        @error('rooms_number')
                            <p class="text-red-700">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2 mb-4 beds-wrapper">
                        <label class="mr-2 font-bold" for="beds">Numero letti *</label>
                        <input class="p-2 flex-grow" type="number" min="1" max="255" name="beds_number" id="beds" placeholder="" value="{{ old('beds_number') }}" required>
                        <div class="beds-error"></div>

                        @error('beds_number')
                            <p class="text-red-700">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2 mb-4 baths-wrapper">
                        <label class="mr-2 font-bold" for="baths">Numero bagni *</label>
                        <input class="p-2 flex-grow" type="number" min="0" max="255" name="bath_number" id="baths" placeholder="" value="{{ old('bath_number') }}" required>
                        <div class="baths-error"></div>

                        @error('bath_number')
                            <p class="text-red-700">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2 mb-4 meters-wrapper">
                        <label class="mr-2 font-bold" for="meters">Metri quadri *</label>
                        <input class="p-2 flex-grow" type="number" min="0" max="65535" name="meters" id="meters" placeholder="" value="{{ old('meters') }}" required>
                        <div class="meters-error"></div>

                        @error('meters')
                            <p class="text-red-700">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                </div>


                @php
                    $key = env('TOMTOM_API_KEY');
                @endphp
                <search-input-component class="text-2xl" api-key="{{ $key }}"></search-input-component>

                @error('address')
                    <p class="text-red-700">
                        {{$message}}
                    </p>
                @enderror

                <div class="flex flex-col gap-2 mb-6">
                    <label class="text-2xl mr-2 font-bold">Servizi</label>
                    <ul class="flex-row  md:flex md:gap-6 md:justify-between border p-3 rounded-lg">
                        @foreach ($services as $service)
                            <li>
                                <input class="p-2" type="checkbox" name="services[]" @if( in_array($service->id, old('service', []))) checked @endif id="{{$service->name}}" value="{{$service->id}}">
                                <label class="mr-2 font-bold" for="{{$service->name}}">{{$service->name}}</label>
                            </li>
                        @endforeach
                    </ul>
                    @error('services.*')
                        <p  class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <!--<div class="flex flex-col gap-2 mb-4">
                    <label class="text-2xl mr-2 font-bold">Sponsorizzazione</label>
                    <ul>
                        @foreach ($sponsors as $sponsor)
                            <li>
                                <input class="p-2" type="radio" name="sponsors[]" @if( in_array($sponsor->id, old('sponsor', []))) checked @endif id="{{$sponsor->plan}}" value="{{$sponsor->id}}">
                                <label class="mr-2" for="{{$sponsor->plan}}">{{$sponsor->plan}}</label>
                            </li>
                        @endforeach
                    </ul>
                    @error('sponsors.*')
                        <p  class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>-->

                <div class="flex flex-col gap-2 mb-4 price-wrapper">
                    <label class="text-2xl mr-2 font-bold" for="price">Prezzo *</label>
                    <input class="p-2 flex-grow" type="number" min="0" name="price" id="price" placeholder="Inserisci il prezzo" value="{{ old('price') }}" required>
                    <div class="price-error"></div>

                    @error('price')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 mb-6">
                    <label class="text-2xl mr-2 font-bold">Aggiungi immagine di copertina *</label>
                    <input type="file" name="image" accept="image/*" id="image" onchange="loadFile(e)" required>
                    <!--<div class="image-preview" id="imagePreview">
                        <img src="" alt="" class="image-preview__image">
                        <span class="image-preview__default-text">Preview</span>
                    </div>-->
                    @error('image')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                    <p class="hidden text-red-700" id="image_error">
                        Seleziona un'immagine valida. Dimensione massima 2 megabyte
                    </p>
                </div>

                <!--galleria-->
                <div>
                    <img src="" alt="">
                </div>

                <div class="flex flex-col gap-2 mb-6">
                    <label class="text-2xl mr-2 font-bold">Aggiungi immagine/i alla galleria</label>
                    <input type="file" name="images[]" accept="image/*" id="images" multiple>
                    @error('images[]')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                    <p class="hidden text-red-700" id="images_error">
                        Selezione delle immagini valide. Dimensione massima 2 megabyte
                    </p>
                </div>

                <!--galleria-->
                <div class="flex">
                    <img src="" alt="">
                </div>

                <div class="flex flex-col gap-2 mb-4">
                    <label class="text-2xl mr-2 font-bold">Visibilità *</label>
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
                <input class="p-2 rounded-lg text-white bg-brand-400 hover:bg-brand-500 cursor-pointer mb-3 px-8 py-3" type="submit" id="submit" value="Salva">
            </form>
            <div><strong>*</strong> indica un campo obbligatorio</div>
        </div>
    </div>

@endsection


<script>
    var loadFile = function()
</script>



<style>

    /*style file selection button
    */
    input[type="file"]::file-selector-button{
        color: white;
        background-color: #ff385c;
        padding: 3px;
        cursor: pointer;
        padding: 5px;
        border-radius: 5px;
        border-color: transparent;
    }

    input[type="text"]{
        border: 1px solid #C3C6D1;
        border-radius: 8px;
    }

    input[type="number"]{
        border: 1px solid #C3C6D1;
        border-radius: 8px;
    }

    .image-preview{
        width: 300px;
        min-height: 100px;
        border: 2px solid #dddddd;
        margin-top:15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #cccccc
    }

    .image-preview__image{
        display: none;
        width: 100%;
    }
</style>