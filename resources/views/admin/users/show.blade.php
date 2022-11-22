@extends('layouts.app')

@section('content')

    <div class="container mx-auto">
        <div class="grid grid-cols-2">
            <img src="{{ $user->profile_pic_path }}" alt="">
            <div class="grid grid-rows-2 gap-8">
                <div>
                    <span class="block text-xl pb-4">Username</span> 
                    <span>{{ $user->name .' '. $user->surname }}</span>
                </div>
                @if($user->date_of_birth)
                <div>
                    <span class="block text-xl pb-4">Data di nascita:</span> 
                    <span>{{ $user->date_of_birth }}</span>
                </div>
                @endif
                <div>
                    <span class="block text-xl pb-4">Email</span> 
                    <span>{{ $user->email }}</span>
                </div>
                <div>
                    <a href="{{ route('admin.users.edit', $user) }}">
                        <button class="bg-blue-500 p-2 rounded">Modifica profilo</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
@endsection