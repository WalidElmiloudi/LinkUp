@extends('layouts.app')

@section('title', 'Change Password')

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
                    @error('current_password', 'updatePassword')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    @error('password', 'updatePassword')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <form action="{{ route('password.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="space-y-6">
                            <div>
                                <label for="current-password" class="block text-sm font-medium text-gray-700 mb-1">Mot de
                                    passe actuel</label>
                                <div class="relative">
                                    <input type="password" id="current-password" name="current_password"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors"
                                        required>
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                        id="toggle-current-password">
                                        <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label for="new-password" class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot
                                    de passe</label>
                                <div class="relative">
                                    <input type="password" id="new-password" name="password"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors"
                                        required>
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                        id="toggle-new-password">
                                        <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-1">Mot de
                                    passe confirmation</label>
                                <div class="relative">
                                    <input type="password" id="confirm-password" name="password_confirmation"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors"
                                        required>
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                        id="toggle-new-password">
                                        <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                            <a href="{{ route('home') }}" type="button" data-page="profile"
                                class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                Annuler
                            </a>
                            <button type="submit"
                                class="cursor-pointer px-6 py-3 border border-transparent rounded-lg font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                Changer le mot de passe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
