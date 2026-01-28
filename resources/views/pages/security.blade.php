        <div id="security-page" class="page hidden animate-fadeIn">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Sécurité du compte</h1>
                <p class="text-gray-600 mt-2">Gérez les paramètres de sécurité de votre compte</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-user-shield mr-2 text-indigo-600"></i> Vérification en deux étapes
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row md:items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Authentification à deux facteurs (2FA)</h3>
                                    <p class="mt-1 text-gray-600">Ajoutez une couche de sécurité supplémentaire à votre compte en exigeant un code de vérification en plus de votre mot de passe lors de la connexion.</p>
                                    <div class="mt-3 flex items-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1"></i> Désactivée
                                        </span>
                                        <span class="ml-3 text-sm text-gray-500">Votre compte est vulnérable</span>
                                    </div>
                                </div>
                                <button id="enable-2fa-btn" class="mt-4 md:mt-0 px-6 py-3 border border-transparent rounded-lg font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                    Activer la 2FA
                                </button>
                            </div>
                            
                            <div id="2fa-setup" class="mt-8 hidden">
                                <div class="border border-gray-200 rounded-xl p-6">
                                    <h4 class="text-lg font-medium text-gray-900 mb-4">Configuration de la 2FA</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <p class="font-medium text-gray-700 mb-2">1. Scannez le QR code avec votre application d'authentification</p>
                                            <div class="bg-gray-100 rounded-lg p-4 flex items-center justify-center">
                                                <div class="h-48 w-48 bg-white p-2 rounded">
                                                    <!-- QR Code placeholder -->
                                                    <div class="h-full w-full bg-gray-300 flex items-center justify-center">
                                                        <span class="text-gray-500">QR Code</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-700 mb-2">2. Entrez le code de vérification</p>
                                            <div class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Code de vérification</label>
                                                    <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors" placeholder="123456" maxlength="6">
                                                </div>
                                                <div class="flex space-x-3">
                                                    <button class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                                        Annuler
                                                    </button>
                                                    <button class="px-4 py-2 border border-transparent rounded-lg font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                                        Vérifier et activer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>