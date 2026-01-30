@extends('layouts.app')

@section('title','Profile')

@section('content')

@include('partials.header')
<div>
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Mon profil</h1>
                <p class="text-gray-600 mt-2">Visualisez et gérez vos informations personnelles</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Informations principales -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-id-card mr-2 text-indigo-600"></i> Informations personnelles
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Nom complet</p>
                                    <p class="mt-1 text-lg font-medium text-gray-900">{{auth()->user()->name}}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Pseudo</p>
                                    <div class="mt-1 flex items-center">
                                        <p class="text-lg font-medium text-gray-900">{{auth()->user()->username}}</p>
                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i> Unique
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Email</p>
                                    <div class="mt-1 flex items-center">
                                        <p class="text-lg font-medium text-gray-900">{{auth()->user()->email}}</p>
                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i> Vérifié
                                        </span>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
@endsection
