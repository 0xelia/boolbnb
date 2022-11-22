<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <style>
    .stroke-title{
        -webkit-text-stroke: 2px rgb(255, 255, 255);
    };
    
    .titles{
        transform: translateY(-100%)
    };
    .lighthouse{
        
    };
    </style>
</head>
<body class="bg-gray-100 h-screen antialiased leading-none h-screen">
<div class="flex flex-col">

    <img class="relative w-screen h-screen object-cover object-center" src="{{asset('/img/background.jpg')}}" alt="">
    {{-- <img  class="absolute  w-screen h-screen object-cover object-center lighthouse" src="{{asset('/img/lighthouse.png')}}" alt=""> --}}



    @if(Route::has('login'))
        <div class="absolute top-0 right-0 mt-4 mr-4">
            @auth
                <a href="{{ route('admin.home') }}" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase">{{ __('Home') }}</a>
            @else
                <a href="{{ route('login') }}" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase pr-6">{{ __('Login') }}</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase">{{ __('Register') }}</a>
                @endif
            @endauth
        </div>
    @endif


    <div class="relative titles text-red-600 w-screen h-screen">
        <h1 class="text-white absolute top-1/2 right-1/2  text-center lowercase font-bold tracking-wider text-xxl mb-6 main-title">
            {{ config('app.name', 'boolbnb') }}
        </h1>
        <img  class="absolute bottom-0  w-screen h-screen object-cover object-center lighthouse" src="{{asset('/img/lighthouse.png')}}" alt="">
        <h2 class=" text-center text-transparent absolute top-1/2 right-1/2   lowercase font-bold tracking-wider text-xxl mb-6 stroke-title">
            {{ config('app.name', 'boolbnb') }}
        </h2>
    </div>
</div>
</body>
</html>
