@extends('layouts.app')

@section('title','Home')

@section('content')

@include('partials.header')
<div >
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Rechercher des membres</h1>
                <p class="text-gray-600 mt-2">Trouvez des membres par pseudo</p>
            </div>
            
            <!-- Barre de recherche -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                <div class="flex flex-col md:flex-row gap-4">
                    <form action="{{ route('users.find') }}" method="post">
                    @csrf
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" name="username" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none" placeholder="Rechercher par pseudo, nom, prénom ou email...">
                        </div>
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <i class="fas fa-search mr-2"></i> Rechercher
                    </button>
                    </form>
                </div>
            </div>
            @if(isset($user))
            <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="font-semibold text-lg">{{ $user->name }}</h3>
            <p class="text-gray-500">{{ $user->username }}</p>
            <p class="text-sm text-gray-400">{{ $user->email }}</p>
            </div>
            @elseif(request()->isMethod('post'))
            <div class="text-center py-12">
            <h3 class="text-xl font-semibold text-gray-700">
            Aucun utilisateur trouvé
            </h3>
            </div>
            @endif 

            </div>
@endsection

@section('footer')

@include('partials.footer')

@endsection