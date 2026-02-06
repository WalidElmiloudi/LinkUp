@extends('layouts.app')

@section('title', 'Modifier la publication')

@section('content')

@include('partials.header')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- En-tête -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Modifier la publication</h1>
        <p class="text-gray-600 mt-2">Modifiez votre contenu, image ou vidéo</p>
        
        <div class="mt-4">
            <a href="{{ url()->previous() ?: route('profile.show', auth()->user()->username) }}" 
               class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour au profil
            </a>
        </div>
    </div>
    
    <!-- Messages de succès/erreur -->
    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-700">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="mb-6 rounded-lg bg-red-100 p-4 text-red-700">
            <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
        </div>
    @endif
    
    <!-- Formulaire d'édition -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Informations de la publication actuelle -->
        <div class="p-6 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Publication actuelle</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Description actuelle -->
                <div class="md:col-span-2">
                    <p class="text-sm font-medium text-gray-700 mb-2">Description :</p>
                    <div class="bg-white p-4 rounded-lg border border-gray-200 min-h-[100px]">
                        <p class="text-gray-800 whitespace-pre-line">{{ $post->description }}</p>
                    </div>
                </div>
                
                <!-- Média actuel -->
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-2">Média actuel :</p>
                    <div class="bg-white p-4 rounded-lg border border-gray-200">
                        @if($post->image)
                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-2">Image :</p>
                                <img src="{{ Storage::url($post->image) }}" 
                                     alt="Image de la publication" 
                                     class="max-w-full h-auto rounded-lg mx-auto max-h-48">
                                <p class="text-xs text-gray-400 mt-2">
                                    <i class="fas fa-image mr-1"></i> 
                                    {{ basename($post->image) }}
                                </p>
                            </div>
                        @elseif($post->video)
                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-2">Vidéo :</p>
                                <div class="bg-gray-800 rounded-lg p-4">
                                    <i class="fas fa-video text-white text-4xl mb-2"></i>
                                    <p class="text-xs text-gray-300">
                                        {{ basename($post->video) }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="text-center text-gray-400 py-4">
                                <i class="fas fa-times-circle text-2xl mb-2"></i>
                                <p class="text-sm">Aucun média</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Formulaire de modification -->
        <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-8">
                <!-- Section Description -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-edit mr-2 text-indigo-600"></i> Description
                        </h2>
                    </div>
                    
                    <textarea name="description" 
                              id="description" 
                              rows="6"
                              placeholder="Modifiez votre description ici..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors resize-none"
                              maxlength="2000">{{ old('description', $post->description) }}</textarea>
                </div>
                
                <!-- Section Média -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-photo-video mr-2 text-indigo-600"></i> Média
                    </h2>
                    
                    <div class="space-y-4">
                        <!-- Option de média -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="media-option cursor-pointer">
                                <input type="radio" name="media_type" value="none" class="sr-only peer" 
                                       {{ !$post->image && !$post->video ? 'checked' : '' }}>
                                <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-indigo-300 peer-checked:border-indigo-500 peer-checked:bg-indigo-50 transition-all">
                                    <i class="fas fa-times text-gray-400 text-2xl mb-2"></i>
                                    <p class="font-medium text-gray-700">Aucun média</p>
                                    <p class="text-sm text-gray-500">Supprimer le média actuel</p>
                                </div>
                            </label>
                            
                            <label class="media-option cursor-pointer">
                                <input type="radio" name="media_type" value="image" class="sr-only peer" 
                                       {{ $post->image ? 'checked' : '' }}>
                                <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-indigo-300 peer-checked:border-indigo-500 peer-checked:bg-indigo-50 transition-all">
                                    <i class="fas fa-image text-blue-400 text-2xl mb-2"></i>
                                    <p class="font-medium text-gray-700">Image</p>
                                    <p class="text-sm text-gray-500">JPG, PNG, GIF</p>
                                </div>
                            </label>
                            
                            <label class="media-option cursor-pointer">
                                <input type="radio" name="media_type" value="video" class="sr-only peer"
                                       {{ $post->video ? 'checked' : '' }}>
                                <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-indigo-300 peer-checked:border-indigo-500 peer-checked:bg-indigo-50 transition-all">
                                    <i class="fas fa-video text-red-400 text-2xl mb-2"></i>
                                    <p class="font-medium text-gray-700">Vidéo</p>
                                    <p class="text-sm text-gray-500">MP4, AVI, MOV</p>
                                </div>
                            </label>
                        </div>
                        
                        <!-- Zone de téléchargement d'image -->
                        <div id="image-upload-section">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6">
                                <div class="text-center">
                                    <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl mb-4"></i>
                                    <p class="font-medium text-gray-700 mb-2">Télécharger une image</p>
                                    <p class="text-sm text-gray-500 mb-4">Glissez-déposez ou cliquez pour sélectionner</p>
                                    
                                    <input type="file" 
                                           name="image" 
                                           id="image-input" 
                                           accept="image/*"
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                    
                                    <p class="text-xs text-gray-400 mt-2">Taille max : 5MB • Formats : JPG, PNG, GIF, WebP</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Zone de téléchargement de vidéo -->
                        <div id="video-upload-section">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6">
                                <div class="text-center">
                                    <i class="fas fa-video text-gray-400 text-4xl mb-4"></i>
                                    <p class="font-medium text-gray-700 mb-2">Télécharger une vidéo</p>
                                    <p class="text-sm text-gray-500 mb-4">Sélectionnez une vidéo depuis votre appareil</p>
                                    
                                    <input type="file" 
                                           name="video" 
                                           id="video-input" 
                                           accept="video/*"
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                    
                                    <p class="text-xs text-gray-400 mt-2">Taille max : 10MB • Formats : MP4, AVI, MOV, MPEG</p>
                                </div>
                            </div>
                        </div>
                        
                        @error('image')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('video')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Section Métadonnées -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Informations sur la publication</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <p class="text-gray-500">Créée le</p>
                            <p class="font-medium text-gray-900">{{ $post->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Dernière modification</p>
                            <p class="font-medium text-gray-900">{{ $post->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Likes</p>
                            <p class="font-medium text-gray-900">{{ $post->likes_count }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Commentaires</p>
                            <p class="font-medium text-gray-900">{{ $post->comments_count }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Boutons d'action -->
            <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-4">

                <div class="flex space-x-4">
                    <a href="{{route('profile.show', auth()->user()->id) }}" 
                       class="cursor-pointer px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        Annuler
                    </a>
                    <button type="submit" 
                            class="cursor-pointer px-6 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <i class="fas fa-save mr-2"></i> Enregistrer les modifications
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div id="delete-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Supprimer cette publication ?</h3>
            <p class="text-sm text-gray-500 mb-6">
                Cette action est irréversible. La publication sera définitivement supprimée.
            </p>
            <div class="flex justify-center space-x-4">
                <button onclick="closeDeleteModal()"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50">
                    Annuler
                </button>
                <form method="POST" action="{{ route('post.destroy', $post->id) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700">
                        Oui, supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.media-option input:checked + div {
    border-color: #4f46e5;
    background-color: #eef2ff;
}

.privacy-option input:checked + div {
    border-color: #4f46e5;
    background-color: #eef2ff;
}

#char-count.warning {
    color: #f59e0b;
}

#char-count.danger {
    color: #ef4444;
}
</style>

@endsection