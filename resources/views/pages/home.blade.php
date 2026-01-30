@extends('layouts.app')

@section('title','Home')

@section('content')

@include('partials.header')

<div id="home-page" class="page animate-fadeIn">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Tableau de bord</h1>
                <p class="text-gray-600 mt-2">Bienvenue sur votre espace personnel LINKUP</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                @include('partials.sidebar')
                <!-- Contenu principal -->
                <div class="lg:col-span-3">
                    <!-- En-tête du profil -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                        <div class="p-6 flex flex-col md:flex-row items-center md:items-start">
                            <div class="mb-6 md:mb-0 md:mr-6">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="h-32 w-32 rounded-full border-4 border-white shadow-lg object-cover">
                            </div>
                            <div class="text-center md:text-left flex-1">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <h1 class="text-2xl font-bold text-gray-900">{{auth()->user()->name}}</h1>
                                        <div class="flex items-center justify-center md:justify-start mt-1">
                                            <span class="text-gray-600">{{auth()->user()->username}}</span>
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i> Vérifié
                                            </span>
                                        </div>
                                    </div>
                                    <a href="/profile/edit" class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="fas fa-edit mr-2"></i> Modifier
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('footer')

@include('partials.footer')

@endsection