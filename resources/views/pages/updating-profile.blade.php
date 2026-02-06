@extends('layouts.app')

@section('title','Home')

@section('content')

@include('partials.header')

<div>
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Modifier mon profil</h1>
                <p class="text-gray-600 mt-2">Mettez à jour vos informations personnelles</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @include('partials.sidebar')
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-user-edit mr-2 text-indigo-600"></i> Informations personnelles
                            </h2>
                        </div>
                        <div class="p-6">
                            @if ($errors->any())
                              <div class="mb-4 rounded-lg bg-red-100 p-3 text-red-700 text-sm">
                                <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                            </div>
                            @endif
                            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                                                              <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-camera mr-2 text-indigo-600"></i> Photo de profil
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-col items-center">
                                <div class="relative mb-6">
                                @if(auth()->user()->profile_photo)
                                <img src="../storage/{{ auth()->user()->profile_photo }}" alt="Avatar" class="h-32 w-32 rounded-full border-4 border-white shadow-lg object-cover">
                                @else
                                <img src="https://intranet.youcode.ma/storage/users/profile/0.jpg" alt="Avatar" class="h-32 w-32 rounded-full border-4 border-white shadow-lg object-cover">
                                @endif
                                    <input type="file" name="image" class="cursor-pointer">
                                </div>
                                <p class="text-sm text-gray-500 text-center">Taille maximale : 5MB. Formats acceptés : JPG, PNG, GIF.</p>
                            </div>
                        </div>
                    </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom Complet</label>
                                        <input type="text" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors" value="{{ auth()->user()->name }}" required>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Pseudo unique</label>
                                        <input type="text" name="username" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors" value="{{ auth()->user()->username }}" required>
                                        <p class="mt-1 text-sm text-gray-500">Ce pseudo sera visible par les autres membres et doit être unique.</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
                                        <div class="flex items-center">
                                            <input type="email" name="email" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors" value="{{ auth()->user()->email }}" required>
                                            <span class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i> Vérifié
                                            </span>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">Un email de vérification sera envoyé si vous changez votre adresse.</p>
                                    </div>
                                </div>
                                
                                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                                    <button type="button" data-page="profile" class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                        Annuler
                                    </button>
                                    <button type="submit" class="px-6 py-3 border border-transparent rounded-lg font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                        Enregistrer les modifications
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection