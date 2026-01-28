        <div id="search-page" class="page hidden animate-fadeIn">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Rechercher des membres</h1>
                <p class="text-gray-600 mt-2">Trouvez des membres par pseudo, nom, prénom ou email</p>
            </div>
            
            <!-- Barre de recherche -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" id="search-input" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none" placeholder="Rechercher par pseudo, nom, prénom ou email...">
                        </div>
                    </div>
                    <button id="search-btn" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <i class="fas fa-search mr-2"></i> Rechercher
                    </button>
                </div>
                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 cursor-pointer hover:bg-gray-200" data-filter="all">Tous</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 cursor-pointer hover:bg-indigo-200" data-filter="verified">Vérifiés</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 cursor-pointer hover:bg-blue-200" data-filter="design">Design</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 cursor-pointer hover:bg-green-200" data-filter="dev">Développement</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 cursor-pointer hover:bg-yellow-200" data-filter="pm">Product</span>
                </div>
            </div>
            
            <!-- Résultats de recherche -->
            <div id="search-results" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Les résultats seront générés dynamiquement ici -->
            </div>
            
            <!-- Aucun résultat -->
            <div id="no-results" class="hidden text-center py-12">
                <i class="fas fa-search text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucun résultat trouvé</h3>
                <p class="text-gray-500 max-w-md mx-auto">Essayez avec d'autres termes de recherche ou ajustez vos filtres.</p>
            </div>
        </div>