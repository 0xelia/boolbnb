@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="mb-3">
            <a href="{{ redirect()->back()->getTargetUrl() }}">Torna indietro</a>
        </div>
        <div class="mb-8">
            <h1 class="text-5xl title font-bold mb-8">
                {{ $apartment->title }}
            </h1>
            <p class="text-2xl font-bold mb-2">Messaggio da {{ $message->name }} {{ $message->surname }}</p>
            <p class="text-lg font-bold mb-2">{{ $message->email }}</p>
            <p>{{ $message->text }}</p>
        </div>
    </div>
@endsection