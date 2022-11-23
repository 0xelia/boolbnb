@extends('layouts.app')

@section('content')

    <div class="container mx-auto">
        <div class="grid grid-cols-2">
            <img style="width: 500px; height: 500px; border-radius: 50%; aspect-ratio:"  class="items-center" src="{{ $user->profile_pic_path }}" alt="">
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
                @if($user->profile_pic)
                <div>
                    <form action="{{ route('admin.users.destroy', $user)}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <input type="submit" class="bg-red-500 p-3 mt-5 rounded text-white cursor-pointer" value="Elimina immagine">
                    </form>
                </div>
                @endif
                <div>
                    <a class="bg-blue-500 p-3 mt-5 rounded text-white" href="{{ route('admin.users.edit', $user) }}" >
                       Modifica profilo
                    </a>
                </div>
            </div>
        </div>
    </div>
    
@endsection