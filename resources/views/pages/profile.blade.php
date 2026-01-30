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
                                    <p class="mt-1 text-lg font-medium text-gray-900">Jean Dupont</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Pseudo</p>
                                    <div class="mt-1 flex items-center">
                                        <p class="text-lg font-medium text-gray-900">@jdupont</p>
                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i> Unique
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Email</p>
                                    <div class="mt-1 flex items-center">
                                        <p class="text-lg font-medium text-gray-900">jean.dupont@example.com</p>
                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i> Vérifié
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Téléphone</p>
                                    <p class="mt-1 text-lg font-medium text-gray-900">+33 6 12 34 56 78</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-sm font-medium text-gray-500">Bio</p>
                                    <p class="mt-1 text-gray-700">
                                        Développeur full-stack passionné par les nouvelles technologies. J'aime le café, le code et les randonnées en montagne. Actuellement en recherche de nouveaux défis techniques.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Activité récente -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden mt-8">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-history mr-2 text-indigo-600"></i> Activité récente
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <i class="fas fa-search text-indigo-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Vous avez recherché "designer UX"</p>
                                        <p class="text-sm text-gray-500">Il y a 2 heures</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                            <i class="fas fa-user-check text-green-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Vous avez connecté avec Marie Lambert</p>
                                        <p class="text-sm text-gray-500">Il y a 1 jour</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-edit text-blue-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Vous avez mis à jour votre bio</p>
                                        <p class="text-sm text-gray-500">Il y a 3 jours</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Statistiques et actions -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-chart-bar mr-2 text-indigo-600"></i> Statistiques
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-6">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Connexions</p>
                                    <p class="mt-1 text-3xl font-bold text-gray-900">127</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Vues du profil</p>
                                    <p class="mt-1 text-3xl font-bold text-gray-900">548</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Membre depuis</p>
                                    <p class="mt-1 text-2xl font-bold text-gray-900">15 Mars 2023</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-cog mr-2 text-indigo-600"></i> Actions rapides
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                <button data-page="edit-profile" class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg text-left hover:bg-gray-50 transition-colors">
                                    <span class="font-medium text-gray-700">
                                        <i class="fas fa-edit mr-2 text-indigo-600"></i> Modifier le profil
                                    </span>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </button>
                                <button data-page="change-password" class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg text-left hover:bg-gray-50 transition-colors">
                                    <span class="font-medium text-gray-700">
                                        <i class="fas fa-key mr-2 text-indigo-600"></i> Changer mot de passe
                                    </span>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </button>
                                <button data-page="security" class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg text-left hover:bg-gray-50 transition-colors">
                                    <span class="font-medium text-gray-700">
                                        <i class="fas fa-shield-alt mr-2 text-indigo-600"></i> Paramètres de sécurité
                                    </span>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </button>
                                <button class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg text-left hover:bg-gray-50 transition-colors">
                                    <span class="font-medium text-gray-700">
                                        <i class="fas fa-download mr-2 text-indigo-600"></i> Exporter mes données
                                    </span>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </button>
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