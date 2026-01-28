        <div id="edit-profile-page" class="page hidden animate-fadeIn">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Modifier mon profil</h1>
                <p class="text-gray-600 mt-2">Mettez à jour vos informations personnelles</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-user-edit mr-2 text-indigo-600"></i> Informations personnelles
                            </h2>
                        </div>
                        <div class="p-6">
                            <form id="edit-profile-form">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="firstname" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                                        <input type="text" id="firstname" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors" value="Jean" required>
                                    </div>
                                    <div>
                                        <label for="lastname" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                                        <input type="text" id="lastname" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors" value="Dupont" required>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Pseudo unique</label>
                                        <input type="text" id="username" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors" value="jdupont" required>
                                        <p class="mt-1 text-sm text-gray-500">Ce pseudo sera visible par les autres membres et doit être unique.</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
                                        <div class="flex items-center">
                                            <input type="email" id="email" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors" value="jean.dupont@example.com" required>
                                            <span class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i> Vérifié
                                            </span>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">Un email de vérification sera envoyé si vous changez votre adresse.</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                                        <textarea id="bio" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors">Développeur full-stack passionné par les nouvelles technologies. J'aime le café, le code et les randonnées en montagne. Actuellement en recherche de nouveaux défis techniques.</textarea>
                                        <p class="mt-1 text-sm text-gray-500">Décrivez-vous en quelques mots (max. 500 caractères). <span id="bio-counter" class="font-medium">148/500</span></p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Localisation</label>
                                        <input type="text" id="location" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors" value="Paris, France">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Site web</label>
                                        <input type="url" id="website" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors" value="https://jdupont.dev">
                                    </div>
                                </div>
                                
                                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                                    <button type="button" data-page="profile" class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                        Annuler
                                    </button>
                                    <button type="submit" class="px-6 py-3 border border-transparent rounded-lg font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                        Enregistrer les modifications
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-camera mr-2 text-indigo-600"></i> Photo de profil
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-col items-center">
                                <div class="relative mb-6">
                                    <img id="avatar-preview" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="h-48 w-48 rounded-full border-4 border-white shadow-lg object-cover">
                                    <button id="change-avatar-btn" class="absolute bottom-0 right-0 h-10 w-10 rounded-full bg-indigo-600 text-white flex items-center justify-center shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="fas fa-camera"></i>
                                    </button>
                                </div>
                                <input type="file" id="avatar-upload" accept="image/*" class="hidden">
                                <p class="text-sm text-gray-500 text-center">Taille maximale : 5MB. Formats acceptés : JPG, PNG, GIF.</p>
                                <button id="remove-avatar-btn" class="mt-4 px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                    Supprimer la photo
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden mt-8">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-bell mr-2 text-indigo-600"></i> Préférences
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-900">Notifications email</p>
                                        <p class="text-sm text-gray-500">Recevoir des emails de notification</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                    </label>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-900">Profil public</p>
                                        <p class="text-sm text-gray-500">Rendre mon profil visible par tous</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                    </label>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-900">Messages privés</p>
                                        <p class="text-sm text-gray-500">Accepter les messages de tous les membres</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>