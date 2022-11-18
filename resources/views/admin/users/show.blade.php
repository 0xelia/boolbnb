@extends('layouts.app')

@section('content')

    <div class="container mx-auto">
        <div class="grid grid-cols-2">
            <img src="{{ $user->profile_pic }}" alt="">
            <div class="grid grid-rows-2 gap-8">
                <div>
                    <span class="block text-xl pb-4">Username</span> 
                    <span>{{ $user->name .' '. $user->surname }}</span>
                </div>
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