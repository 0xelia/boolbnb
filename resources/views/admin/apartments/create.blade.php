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
                    <label class="mr-2 font-bold" for="title">Titolo:</label>
                    <input class="p-2 flex-grow" type="text" name="title" id="title" placeholder="Inserisci un titolo">
                </div>
                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="rooms">Numero camere:</label>
                    <input class="p-2 flex-grow" type="number" name="rooms" id="rooms" placeholder="Inserisci numero delle camere">
                </div>
                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="beds">Numero letti:</label>
                    <input class="p-2 flex-grow" type="number" name="beds" id="beds" placeholder="Inserisci numero dei letti">
                </div>
                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="baths">Numero bagni:</label>
                    <input class="p-2 flex-grow" type="number" name="baths" id="baths" placeholder="Inserisci numero dei bagni">
                </div>
                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="meters">Metri quadri:</label>
                    <input class="p-2 flex-grow" type="number" name="meters" id="meters" placeholder="Inserisci metri quadri">
                </div>
                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="image">Aggiungi immagine di copertina:</label>
                    <input type="file" name="image" id="image">
                </div>
                <div class="flex flex-col gap-2 mb-4">
                    <label class="mr-2 font-bold" for="images">Aggiungi immagine/i alla galleria:</label>
                    <input type="file" name="images[]" id="images" multiple>
                </div>
                <input class="p-2 border-2 rounded-lg bg-transparent cursor-pointer" type="submit" value="DAIIII">
            </form>
        </div>
    </div>
@endsection