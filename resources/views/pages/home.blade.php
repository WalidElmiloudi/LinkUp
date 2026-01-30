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
                                        <h1 class="text-2xl font-bold text-gray-900">Jean Dupont</h1>
                                        <div class="flex items-center justify-center md:justify-start mt-1">
                                            <span class="text-gray-600">@jdupont</span>
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i> Vérifié
                                            </span>
                                        </div>
                                    </div>
                                    <button id="edit-profile-btn" class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="fas fa-edit mr-2"></i> Modifier
                                    </button>
                                </div>
                                <p class="mt-4 text-gray-700 max-w-2xl">
                                    Développeur full-stack passionné par les nouvelles technologies. J'aime le café, le code et les randonnées en montagne. Actuellement en recherche de nouveaux défis techniques.
                                </p>
                                <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <div class="text-center">
                                        <p class="text-sm text-gray-500">Connexions</p>
                                        <p class="text-xl font-bold text-gray-900">127</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-sm text-gray-500">Membre depuis</p>
                                        <p class="text-xl font-bold text-gray-900">Mars 2023</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-sm text-gray-500">Activité</p>
                                        <p class="text-xl font-bold text-gray-900">Élevée</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-sm text-gray-500">Statut</p>
                                        <p class="text-xl font-bold text-green-600">En ligne</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Suggestions de connexion -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-users mr-2 text-indigo-600"></i> Suggestions de connexion
                            </h2>
                            <p class="text-gray-600 mt-1">Découvrez des membres avec des intérêts similaires</p>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Carte utilisateur 1 -->
                                <div class="user-card bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex items-start">
                                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Avatar" class="h-16 w-16 rounded-full border-2 border-white shadow object-cover">
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h3 class="font-bold text-gray-900">Marie Lambert</h3>
                                                    <div class="flex items-center mt-1">
                                                        <span class="text-gray-600 text-sm">@mlambert</span>
                                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            <i class="fas fa-check-circle mr-1"></i> Vérifié
                                                        </span>
                                                    </div>
                                                </div>
                                                <button class="text-indigo-600 hover:text-indigo-800">
                                                    <i class="fas fa-user-plus"></i>
                                                </button>
                                            </div>
                                            <p class="mt-2 text-gray-700 text-sm">Designer UX passionnée par le design centré sur l'utilisateur et les interfaces intuitives.</p>
                                            <div class="mt-3 flex flex-wrap gap-2">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">UI/UX</span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Figma</span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800">Design</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Carte utilisateur 2 -->
                                <div class="user-card bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex items-start">
                                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Avatar" class="h-16 w-16 rounded-full border-2 border-white shadow object-cover">
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h3 class="font-bold text-gray-900">Thomas Martin</h3>
                                                    <div class="flex items-center mt-1">
                                                        <span class="text-gray-600 text-sm">@tmartin</span>
                                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            <i class="fas fa-check-circle mr-1"></i> Vérifié
                                                        </span>
                                                    </div>
                                                </div>
                                                <button class="text-indigo-600 hover:text-indigo-800">
                                                    <i class="fas fa-user-plus"></i>
                                                </button>
                                            </div>
                                            <p class="mt-2 text-gray-700 text-sm">Product Manager avec 8 ans d'expérience dans la gestion de produits digitaux innovants.</p>
                                            <div class="mt-3 flex flex-wrap gap-2">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Product</span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Agile</span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">Strategy</span>
                                            </div>
                                        </div>
                                    </div>
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