@extends('layouts.app')

@section('title','Change Password')

@section('content')
<div>
            <div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
                <div class="max-w-md w-full space-y-8">
                    <div>
                        <div class="flex justify-center">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-link text-indigo-600 text-4xl"></i>
                                <span class="text-4xl font-bold text-indigo-600">LINKUP</span>
                            </div>
                        </div>
                        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                            Récupération de mot de passe
                        </h2>
                        <p class="mt-2 text-center text-sm text-gray-600">
                            Entrez votre email pour réinitialiser votre mot de passe
                        </p>
                    </div>
                    <form method="post" action="{{route('password.email') }}" class="mt-8 space-y-6">
                        @csrf
                        <div class="rounded-md shadow-sm">
                            <div>
                                <label for="reset-email" class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
                                <input id="reset-email" name="email" type="email" required class="appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="vous@exemple.com">
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                    <i class="fas fa-paper-plane text-indigo-500 group-hover:text-indigo-400"></i>
                                </span>
                                Envoyer le lien de réinitialisation
                            </button>
                        </div>
                        
                        <div class="text-center">
                            <a href="/" class="font-medium text-indigo-600 hover:text-indigo-500">
                                <i class="fas fa-arrow-left mr-1"></i> Retour à la connexion
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection