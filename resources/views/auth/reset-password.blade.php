@extends('layouts.app')

@section('title','Reset Password')

@section('content')
    <!-- Carte de réinitialisation -->
    <div class="max-w-md w-full mx-auto">
        <!-- En-tête avec logo -->
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-link text-indigo-600 text-4xl"></i>
                    <span class="text-4xl font-bold text-indigo-600">LINKUP</span>
                </div>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Réinitialiser votre mot de passe</h1>
            <p class="text-gray-600 mt-2">Créez un nouveau mot de passe sécurisé</p>
        </div>

        <!-- Carte principale -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- En-tête de la carte -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6 text-white text-center">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-key text-2xl"></i>
                </div>
                <h2 class="text-xl font-bold">Nouveau mot de passe</h2>
                <p class="text-indigo-100 mt-1">Veuillez saisir votre nouveau mot de passe</p>
            </div>

            <!-- Contenu du formulaire -->
            <div class="p-6 md:p-8">
                <!-- Informations de l'utilisateur -->
                <div class="mb-6 p-4 bg-indigo-50 rounded-lg border border-indigo-100">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">{{$request->email}}</p>
                            <p class="text-xs text-gray-500">Lien de réinitialisation valide</p>
                        </div>
                    </div>
                </div>

                <!-- Messages d'information -->
                <div id="success-message" class="hidden mb-6 p-4 rounded-lg border border-green-200 bg-green-50">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">Votre mot de passe a été réinitialisé avec succès !</p>
                            <p class="text-xs text-green-600 mt-1">Vous allez être redirigé vers la page de connexion.</p>
                        </div>
                    </div>
                </div>

                <div id="error-message" class="hidden mb-6 p-4 rounded-lg border border-red-200 bg-red-50">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800" id="error-text"></p>
                        </div>
                    </div>
                </div>

                <!-- Formulaire de réinitialisation -->
                <form  class="space-y-6">
                    <!-- Champ nouveau mot de passe -->
                    <div>
                        <label for="new-password" class="block text-sm font-medium text-gray-700 mb-2">
                            Nouveau mot de passe
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="new-password" 
                                name="new-password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 form-input"
                                placeholder="Saisissez votre nouveau mot de passe"
                                required
                                minlength="8"
                            >
                            <button 
                                type="button" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                id="toggle-new-password"
                                aria-label="Afficher/masquer le mot de passe"
                            >
                                <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Champ confirmation du mot de passe -->
                    <div>
                        <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirmer le nouveau mot de passe
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="confirm-password" 
                                name="confirm-password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 form-input"
                                placeholder="Confirmez votre nouveau mot de passe"
                                required
                                minlength="8"
                            >
                            <button 
                                type="button" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                id="toggle-confirm-password"
                                aria-label="Afficher/masquer le mot de passe"
                            >
                                <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                            </button>
                        </div>
                        <div id="password-match-message" class="mt-2 text-sm"></div>
                    </div>

                    <!-- Conseils de sécurité -->
                    <div class="p-4 bg-blue-50 rounded-lg border border-blue-100">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-shield-alt text-blue-500 mt-0.5"></i>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-blue-900">Conseils pour un mot de passe sécurisé</h4>
                                <ul class="mt-2 space-y-1 text-sm text-blue-700">
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-blue-500 mr-2 mt-0.5 text-xs"></i>
                                        <span>Utilisez au moins 12 caractères</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-blue-500 mr-2 mt-0.5 text-xs"></i>
                                        <span>Évitez les mots courants ou informations personnelles</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-blue-500 mr-2 mt-0.5 text-xs"></i>
                                        <span>Utilisez une combinaison de lettres, chiffres et symboles</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="pt-4">
                        <button 
                            type="submit" 
                            id="submit-btn"
                            class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 btn-transition disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <i class="fas fa-key mr-2"></i>
                            <span>Réinitialiser le mot de passe</span>
                            <span id="loading-spinner" class="hidden ml-2">
                                <i class="fas fa-spinner fa-spin"></i>
                            </span>
                        </button>
                    </div>
                </form>

                <!-- Liens supplémentaires -->
                <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                    <p class="text-sm text-gray-600">
                        Vous vous souvenez de votre mot de passe ?
                        <a href="login.html" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Se connecter
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Informations de sécurité -->
        <div class="mt-6 text-center">
            <div class="inline-flex items-center text-xs text-gray-500">
                <i class="fas fa-lock mr-1"></i>
                <span>Vos informations sont sécurisées et cryptées</span>
            </div>
            <p class="text-xs text-gray-400 mt-2">
                Ce lien de réinitialisation expire dans <span class="font-medium">24 heures</span>.
                <br>
                Si vous n'avez pas demandé cette réinitialisation, veuillez ignorer cet email.
            </p>
        </div>
    </div>

    <!-- Modal de succès -->
    <div id="success-modal" class="fixed inset-0 bg-gray-500 bg-opacity-75 items-center justify-center p-4 hidden z-50">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 animate-fadeIn">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
                    <i class="fas fa-check text-green-600 text-2xl"></i>
                </div>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Mot de passe réinitialisé !</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500">
                        Votre mot de passe a été changé avec succès. Vous pouvez maintenant vous connecter avec votre nouveau mot de passe.
                    </p>
                </div>
                <div class="mt-6">
                    <a href="{{route('login')}}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Se connecter
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection