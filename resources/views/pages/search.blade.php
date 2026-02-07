@extends('layouts.app')

@section('title', 'Home')

@section('content')

    @include('partials.header')
    <div>
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Rechercher des membres</h1>
            <p class="text-gray-600 mt-2">Trouvez des membres par pseudo</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <form action="{{ route('users.find') }}" method="post">
                @csrf
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" name="username"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none"
                                placeholder="Rechercher par pseudo">
                        </div>
                    </div>
                    <button type="submit"
                        class="cursor-pointer inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <i class="fas fa-search mr-2"></i> Rechercher
                    </button>
                </div>
            </form>
        </div>
        @if (isset($user))
            <div class="w-full h-30 rounded-md border flex items-center bg-white gap-5 px-5 justify-between">
                <div class="flex items-center bg-white gap-5 px-5">
                    <a href="{{ route('profile.show', $user->id) }}" class="cursor-pointer w-20 h-20 rounded-full">
                        @if ($user->profile_photo)
                            <img class="w-full h-full rounded-full" src="{{ asset('storage/' . $user->profile_photo) }}"
                                alt="avatar">
                        @else
                            <img class="w-full h-full rounded-full"
                                src="https://intranet.youcode.ma/storage/users/profile/0.jpg" alt="avatar">
                        @endif
                    </a>
                    <div class="flex flex-col">
                        <a href="{{ route('profile.show', $user->id) }}"
                            class="cursor-pointer text-xl font-bold">{{ $user->name }}</a>
                        <a href="{{ route('profile.show', $user->id) }}"
                            class="cursor-pointer text-md text-gray-400 font-semibold">{{ '@' . $user->username }}</a>
                    </div>
                </div>
                @if ($user->id !== auth()->user()->id)
                    @if (auth()->user()->isFriendWith($user->id))
                        <h1 class="cursor-pointer bg-blue-500 text-xl font-bold px-5 py-2 rounded-md text-white">
                            {{ 'Ami(e)' }}</h1>
                    @elseif(auth()->user()->hasPendingRequestTo($user->id))
                        <h1 class="cursor-pointer bg-gray-500 text-xl font-bold px-5 py-2 rounded-md text-gray-100">Envoyée
                        </h1>
                    @else
                        <form action="{{ route('friend.sendRequest') }}" method="POST">
                            @csrf
                            <input type="hidden" name="reciever_id" value="{{ $user->id }}">
                            <button type="submit"
                                class="cursor-pointer bg-green-500 text-xl font-bold px-5 py-2 rounded-md text-white">Inviter</button>
                        </form>
                    @endif
                @endif
            </div>
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
