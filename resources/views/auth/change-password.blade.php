@extends('layouts.app')

@section('title','Change Password')

@section('content')
    <div>
            <div class="max-w-2xl mx-auto">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Changer le mot de passe</h1>
                    <p class="text-gray-600 mt-2">Mettez à jour votre mot de passe pour renforcer la sécurité de votre compte</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-key mr-2 text-indigo-600"></i> Sécurité du compte
                        </h2>
                    </div>
                    <div class="p-6">
                        <form id="change-password-form">
                            <div class="space-y-6">
                                <div>
                                    <label for="current-password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe actuel</label>
                                    <div class="relative">
                                        <input type="password" id="current-password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors" required>
                                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" id="toggle-current-password">
                                            <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="new-password" class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot de passe</label>
                                    <div class="relative">
                                        <input type="password" id="new-password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors" required>
                                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" id="toggle-new-password">
                                            <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                                        </button>
                                    </div>
                                    <div class="mt-4">
                                        <p class="text-sm font-medium text-gray-700 mb-2">Force du mot de passe</p>
                                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div id="password-strength-bar" class="password-strength-bar h-full bg-red-500 w-1/4"></div>
                                        </div>
                                        <p id="password-strength-text" class="mt-1 text-sm text-red-500">Faible</p>
                                    </div>
                                    <ul class="mt-3 text-sm text-gray-500 space-y-1">
                                        <li id="length-requirement" class="flex items-center">
                                            <i class="fas fa-times text-red-500 mr-2"></i>
                                            <span>Au moins 8 caractères</span>
                                        </li>
                                        <li id="uppercase-requirement" class="flex items-center">
                                            <i class="fas fa-times text-red-500 mr-2"></i>
                                            <span>Au moins une majuscule</span>
                                        </li>
                                        <li id="number-requirement" class="flex items-center">
                                            <i class="fas fa-times text-red-500 mr-2"></i>
                                            <span>Au moins un chiffre</span>
                                        </li>
                                        <li id="special-requirement" class="flex items-center">
                                            <i class="fas fa-times text-red-500 mr-2"></i>
                                            <span>Au moins un caractère spécial</span>
                                        </li>
                                    </ul>
                                </div>
                                
                                <div>
                                    <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-1">Confirmer le nouveau mot de passe</label>
                                    <div class="relative">
                                        <input type="password" id="confirm-password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors" required>
                                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" id="toggle-confirm-password">
                                            <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                                        </button>
                                    </div>
                                    <p id="password-match" class="mt-2 text-sm"></p>
                                </div>
                            </div>
                            
                            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                                <button type="button" data-page="profile" class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                    Annuler
                                </button>
                                <button type="submit" class="px-6 py-3 border border-transparent rounded-lg font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                    Changer le mot de passe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mt-8">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-shield-alt mr-2 text-indigo-600"></i> Conseils de sécurité
                        </h2>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                <span>Utilisez un mot de passe unique que vous n'utilisez nulle part ailleurs</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                <span>Évitez les informations personnelles comme votre date de naissance ou votre nom</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                <span>Changez votre mot de passe régulièrement (tous les 3-6 mois)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                <span>Activez la vérification en deux étapes pour plus de sécurité</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
@endsection
        