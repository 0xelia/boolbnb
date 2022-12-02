@extends('layouts.app')

@section('content')

    <div class="flex flex-col md:flex-row gap-15 container mx-auto">
        <div class="flex flex-col items-center content-start text-center">
            <div class=" h-60 w-60 relative">
                @if($user->profile_pic)
                    <img class=" items-center object-cover rounded-full" src="{{ $user->profile_pic_path }}" alt="">
                @else
                <div>
                    <img class="items-center rounded-full" src="https://cdn-icons-png.flaticon.com/512/1144/1144709.png" alt="">
                </div>
                @endif
                <div class="absolute top-3 right-3">
                    <a class="bg-blue-500 p-3 mt-5 rounded-full text-white" href="{{ route('admin.users.edit', $user) }}" >
                        <i class="w-5 h-5 fa-solid fa-pen"></i>
                    </a>
                </div>
            </div>
            <div class="grid grid-rows-2 gap-8 pt-10">
                <div>
                    <span class="text-3xl font-semibold text-gray-700">{{ $user->name .' '. $user->surname }}</span>
                </div>
                <div>
                    <span class="block text-xl pb-4  font-semibold text-gray-700">Data di nascita:</span> 
                    @if($user->date_of_birth) 
                        <span>{{ $user->date_of_birth }}</span>
                    @else
                        <span> --/--/-- </span>
                    @endif  
                </div>
                <div>
                    <span class="block text-xl pb-4  font-semibold text-gray-700">Email</span> 
                    <span>{{ $user->email }}</span>
                </div>
            </div>
        </div>
        <div class="border-t md:border-l md:border-t-0 border-gray-300 flex-grow md:pl-10 md:pt-0 pt-10">
            <div class=" grid grid-cols-1">
                <h2 class="text-gray-700 text-2xl pb-5 font-semibold">Riepilogo appartamenti</h2>
                <ul class="flex flex-col gap-5 w-full">
                    @foreach ($apartments as $apartment)
                    <li>
                        <a class="flex-grow flex items-center rounded-lg gap-3 bg-cool-gray-300" href="{{ route('admin.apartments.show', $apartment) }}">
                            <span class="flex-grow text-base md:text-xl pl-4 font-semibold">{{$apartment->title}}</span>
                            <img class=" w-28 h-28 object-cover rounded-r-lg" src="{{$apartment->pic_path}}" alt="">
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    
@endsection