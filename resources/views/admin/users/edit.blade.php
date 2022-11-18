@extends('layouts.app')

@section('content')

    <div class="container mx-auto">
        <div class="grid grid-cols-1 gap-8">
            <h2 class="bolder">Modifica profilo</h2>
            <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                  <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                        Nome
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="name" value="{{ old('name', $user->name) }}" id="name">
                      @error('name')
                      <div id="name" class="invalid-feedback">
                          {{ $message }}
                      </div>
                    @enderror
                    </div>

                    <div class="w-full md:w-1/2 px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="surname">
                        Cognome
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="surname" value="{{ old('surname', $user->surname) }}" id="surname">
                    </div>
                    @error('surname')
                      <div id="surname" class="invalid-feedback">
                          {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="date_of_birth">
                        Data di nascita
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="date" name="date_of_birth" value="@if($user->date_of_birth) {{ old('surname', $user->date_of_birth) }} @endif" id="date_of_birth">
                      @error('date_of_birth')
                            <div id="date_of_birth" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                        Email
                      </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="email" name="email" value="{{ old('email', $user->email) }}" id="email">
                        @error('email')
                            <div id="email" class="pt-2 text-red italic text-red-700 invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                        Password
                      </label>
                      <input class=" appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="password" name="password" id="password">
                      @error('password')
                            <div id="password" class="pt-2 text-red italic text-red-700 invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mt-6">
                  <div class="w-full md:w-3/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="profile_pic">
                      Immagine Profilo
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="file" name="profile_pic" id="profile_pic">
                    @error('profile_pic')
                          <div id="profile_pic" class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>
                </div>

                  

                <button class="bg-blue-500 p-3 mt-5 rounded text-white">Salva</button>
            </form>
            
        </div>
    </div>
    
@endsection