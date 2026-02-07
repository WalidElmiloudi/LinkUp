@extends('layouts.app')

@section('title', 'Home')

@section('content')

    @include('partials.header')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @include('partials.sidebar')
            <div class="lg:col-span-2">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Fil d'actualités</h1>
                    <p class="text-gray-600 mt-2">Les dernières publications de vos amis</p>
                </div>

                @if (session('success'))
                    <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-700">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                @endif

                @auth
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
                        <div class="flex items-center space-x-4 mb-6">
                            @if (auth()->user()->profile_photo)
                                <img src="{{ Storage::url(auth()->user()->profile_photo) }}" alt="{{ auth()->user()->name }}"
                                    class="h-12 w-12 rounded-full object-cover">
                            @else
                                <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <i class="fas fa-user text-indigo-400"></i>
                                </div>
                            @endif
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ auth()->user()->name }}</h3>
                                <p class="text-sm text-gray-500">{{ '@ ' . auth()->user()->username }}</p>
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="mb-4 p-4 rounded-lg bg-red-50 text-red-700">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                            <textarea name="description" rows="3" placeholder="Partagez quelque chose avec vos amis..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors resize-none"></textarea>

                            <div class="mt-4 flex justify-between items-center">
                                <div class="flex space-x-4">
                                    <label for="image-upload"
                                        class="cursor-pointer flex items-center space-x-2 text-gray-500 hover:text-indigo-600">
                                        <i class="fas fa-image"></i>
                                        <span>Photo</span>
                                    </label>
                                    <input type="file" name="image" id="image-upload" class="hidden">
                                    <label for="video-upload"
                                        class="cursor-pointer flex items-center space-x-2 text-gray-500 hover:text-indigo-600">
                                        <i class="fas fa-video"></i>
                                        <span>Vidéo</span>
                                    </label>
                                    <input type="file" name="video" id="video-upload" class="hidden">

                                </div>

                                <button type="submit"
                                    class="cursor-pointer px-6 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                    Publier
                                </button>
                            </div>
                        </form>
                    </div>
                @endauth

                @if ($posts->isEmpty())
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                        <i class="fas fa-newspaper text-gray-300 text-6xl mb-4"></i>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">Aucune publication</h3>
                        <p class="text-gray-500 mb-6">
                            @auth
                                Suivez plus d'amis pour voir leurs publications ici !
                            @else
                                Connectez-vous pour voir les publications de vos amis
                            @endauth
                        </p>
                    </div>
                @else
                    <div class="space-y-6">
                        @foreach ($posts as $post)
                            @if (auth()->user()->isFriendWith($post->user->id))
                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                    <div class="p-6 border-b border-gray-200">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <a href="{{ route('profile.show', $post->user->username) }}">
                                                    @if ($post->user->profile_photo)
                                                        <img src="{{ Storage::url($post->user->profile_photo) }}"
                                                            alt="{{ $post->user->name }}"
                                                            class="h-10 w-10 rounded-full object-cover">
                                                    @else
                                                        <div
                                                            class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                            <i class="fas fa-user text-indigo-400"></i>
                                                        </div>
                                                    @endif
                                                </a>
                                                <div>
                                                    <a href="{{ route('profile.show', $post->user->username) }}"
                                                        class="font-semibold text-gray-900 hover:text-indigo-600">
                                                        {{ $post->user->name }}
                                                    </a>
                                                    <p class="text-sm text-gray-500">
                                                        {{ '@ ' . $post->user->username }} •
                                                        {{ $post->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>

                                            @auth
                                                @if (auth()->id() === $post->user_id || auth()->user()->is_admin)
                                                    <div class="relative">
                                                        <button type="button" class="text-gray-400 hover:text-gray-600"
                                                            onclick="togglePostMenu({{ $post->id }})">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </button>
                                                        <div id="post-menu-{{ $post->id }}"
                                                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10 hidden">
                                                            @if (auth()->id() === $post->user_id)
                                                                <a href="{{ route('post.edit', $post->id) }}"
                                                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                                    <i class="fas fa-edit mr-2"></i> Modifier
                                                                </a>
                                                                <form method="POST"
                                                                    action="{{ route('post.destroy', $post->id) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button"
                                                                        onclick="confirmDelete({{ $post->id }})"
                                                                        class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                                                        <i class="fas fa-trash mr-2"></i> Supprimer
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>

                                    <div class="p-6">
                                        <p class="text-gray-800 whitespace-pre-line">{{ $post->description }}</p>

                                        @if ($post->image)
                                            <div class="mt-4">
                                                <img src="{{ Storage::url($post->image) }}" alt="Publication image"
                                                    class="rounded-lg max-w-full h-auto cursor-pointer"
                                                    onclick="openMediaModal('{{ Storage::url($post->image) }}', 'image')">
                                            </div>
                                        @elseif($post->video)
                                            <div class="mt-4">
                                                <video controls class="rounded-lg max-w-full h-auto max-h-96">
                                                    <source src="{{ Storage::url($post->video) }}" type="video/mp4">
                                                    Votre navigateur ne supporte pas la lecture vidéo.
                                                </video>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="px-6 py-3 border-t border-gray-200 bg-gray-50">
                                        <div class="flex items-center justify-between text-sm text-gray-500">
                                            <div class="flex items-center space-x-4">
                                                <span class="flex items-center space-x-1">
                                                    <i class="fas fa-heart text-red-500"></i>
                                                    <span>{{ $post->likes->count() }} j'aime</span>
                                                </span>
                                                <span class="flex items-center space-x-1">
                                                    <i class="fas fa-comment"></i>
                                                    <span>{{ $post->comments->count() }} commentaires</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    @auth
                                        <div class=" grid grid-cols-2 border-t border-gray-100 pt-4 px-4"
                                            x-data="{ open: false }">
                                            @if ($post->isLikedBy(auth()->user()))
                                                <form method="POST" action="{{ route('posts.unlike', $post->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="cursor-pointer flex items-center justify-center space-x-2 text-gray-600 hover:text-red-500 py-2 rounded-lg hover:bg-gray-50">
                                                        <i class="fas fa-heart text-red-500"></i>
                                                        <span class="font-medium">J'aime</span>
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('posts.like', $post->id) }}">
                                                    @csrf
                                                    <button type="submit"
                                                        class="cursor-pointer flex items-center justify-center space-x-2 text-gray-600 hover:text-red-500 py-2 rounded-lg hover:bg-gray-50">
                                                        <i class="far fa-heart"></i>
                                                        <span class="font-medium">J'aime</span>
                                                    </button>
                                                </form>
                                            @endif

                                            <button @click="open = true"
                                                class="text-gray-500 hover:text-indigo-600 flex items-center space-x-2 cursor-pointer">
                                                <i class="fas fa-comment"></i>
                                                <span>Commenter</span>
                                            </button>
                                            <div x-show="open" x-cloak
                                                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

                                                <div @click.outside="open = false"
                                                    class="bg-white w-full max-w-lg rounded-xl shadow-lg p-6">
                                                    <div class="flex justify-between items-center mb-4">
                                                        <h2 class="text-lg font-semibold">Commentaires</h2>
                                                        <button @click="open = false">
                                                            <i class="fas fa-times text-gray-500"></i>
                                                        </button>
                                                    </div>

                                                    <div class="space-y-4 max-h-80 overflow-y-auto">

                                                        @forelse($post->comments as $comment)
                                                            <div class="flex space-x-3">

                                                                @if ($comment->user?->profile_photo)
                                                                    <img src="{{ Storage::url($comment->user->profile_photo) }}"
                                                                        class="h-8 w-8 rounded-full object-cover">
                                                                @else
                                                                    <div class="h-8 w-8 rounded-full bg-gray-200"></div>
                                                                @endif

                                                                <div class="flex-1">
                                                                    <p class="text-sm">
                                                                        <span class="font-medium">
                                                                            {{ $comment->user?->name ?? 'Deleted user' }}
                                                                        </span>
                                                                        {{ $comment->content }}
                                                                    </p>
                                                                    <p class="text-xs text-gray-500 mt-1">
                                                                        {{ $comment->created_at->diffForHumans() }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @empty
                                                            <p class="text-sm text-gray-500 text-center">
                                                                Aucun commentaire pour le moment
                                                            </p>
                                                        @endforelse

                                                    </div>

                                                    <form method="POST" action="{{ route('comments.store', $post) }}"
                                                        class="mt-4 flex space-x-3">
                                                        @csrf
                                                        <input type="text" name="content"
                                                            placeholder="Ajouter un commentaire..."
                                                            class="flex-1 px-4 py-2 border border-gray-300 rounded-full
                                        focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                                                            required>
                                                        <button type="submit"
                                                            class="px-4 py-2 bg-indigo-600 text-white rounded-full">
                                                            <i class="fas fa-paper-plane"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endauth
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
