<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LINKUP - Plateforme de connexion sociale</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        /* Animations personnalisées */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideInRight {
            from { transform: translateX(100%); }
            to { transform: translateX(0); }
        }
        
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }
        
        .animate-slideInRight {
            animation: slideInRight 0.3s ease-out;
        }
        
        /* Styles personnalisés pour améliorer Tailwind */
        .password-strength-bar {
            transition: width 0.3s ease, background-color 0.3s ease;
        }
        
        .sidebar-link.active {
            background-color: rgba(79, 70, 229, 0.1);
            color: #4f46e5;
            border-left: 3px solid #4f46e5;
        }
        
        .user-card:hover {
            transform: translateY(-5px);
            transition: transform 0.2s ease;
        }
        
        .notification {
            transition: transform 0.3s ease;
        }
        
        .notification.hidden {
            transform: translateX(150%);
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        /* Scrollbar personnalisée */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <!-- Notification -->
    <div id="notification" class="notification fixed top-5 right-5 z-50 max-w-md w-full bg-white rounded-lg shadow-lg border-l-4 border-blue-500 p-4 hidden">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-blue-500 text-xl"></i>
            </div>
            <div class="ml-3 flex-1">
                <p id="notification-message" class="text-sm font-medium text-gray-900">
                    Votre profil a été mis à jour avec succès
                </p>
            </div>
            <div class="ml-4 flex-shrink-0 flex">
                <button id="close-notification" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none">
                    <span class="sr-only">Fermer</span>
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Header (visible uniquement quand connecté) -->
    <header id="main-header" class="bg-white shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-link text-indigo-600 text-2xl"></i>
                        <span class="text-2xl font-bold text-indigo-600">LINKUP</span>
                    </div>
                </div>

                <!-- Navigation principale -->
                <nav class="hidden md:flex space-x-4">
                    <a href="#" data-page="home" class="nav-link px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-100 transition-colors">
                        <i class="fas fa-home mr-1"></i> Accueil
                    </a>
                    <a href="#" data-page="search" class="nav-link px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-100 transition-colors">
                        <i class="fas fa-search mr-1"></i> Recherche
                    </a>
                    <a href="#" data-page="profile" class="nav-link px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-100 transition-colors">
                        <i class="fas fa-user mr-1"></i> Profil
                    </a>
                    <a href="#" data-page="settings" class="nav-link px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-100 transition-colors">
                        <i class="fas fa-cog mr-1"></i> Paramètres
                    </a>
                </nav>

                <!-- Menu utilisateur -->
                <div class="flex items-center space-x-3">
                    <!-- Avatar utilisateur -->
                    <div class="relative">
                        <img id="user-avatar" class="h-10 w-10 rounded-full border-2 border-gray-200 object-cover cursor-pointer" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar">
                    </div>
                    
                    <!-- Bouton déconnexion -->
                    <button id="logout-btn" class="hidden md:inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                    </button>
                    
                    <!-- Menu mobile -->
                    <button id="mobile-menu-button" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-indigo-600 hover:bg-gray-100 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Menu mobile -->
            <div id="mobile-menu" class="md:hidden hidden pb-3 border-t border-gray-200">
                <div class="pt-2 space-y-1">
                    <a href="#" data-page="home" class="mobile-nav-link block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-100">
                        <i class="fas fa-home mr-2"></i> Accueil
                    </a>
                    <a href="#" data-page="search" class="mobile-nav-link block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-100">
                        <i class="fas fa-search mr-2"></i> Recherche
                    </a>
                    <a href="#" data-page="profile" class="mobile-nav-link block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-100">
                        <i class="fas fa-user mr-2"></i> Profil
                    </a>
                    <a href="#" data-page="settings" class="mobile-nav-link block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-100">
                        <i class="fas fa-cog mr-2"></i> Paramètres
                    </a>
                    <button id="mobile-logout-btn" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-100">
                        <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page d'accueil -->
        <div id="home-page" class="page animate-fadeIn">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Tableau de bord</h1>
                <p class="text-gray-600 mt-2">Bienvenue sur votre espace personnel LINKUP</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Menu</h2>
                        </div>
                        <nav class="p-4 space-y-1">
                            <a href="#" data-page="home" class="sidebar-link block px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                                <i class="fas fa-home mr-3"></i> Tableau de bord
                            </a>
                            <a href="#" data-page="profile" class="sidebar-link block px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                                <i class="fas fa-user mr-3"></i> Mon profil
                            </a>
                            <a href="#" data-page="search" class="sidebar-link block px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                                <i class="fas fa-search mr-3"></i> Rechercher
                            </a>
                            <a href="#" data-page="edit-profile" class="sidebar-link block px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                                <i class="fas fa-edit mr-3"></i> Modifier profil
                            </a>
                            <a href="#" data-page="change-password" class="sidebar-link block px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                                <i class="fas fa-key mr-3"></i> Changer mot de passe
                            </a>
                            <a href="#" data-page="security" class="sidebar-link block px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                                <i class="fas fa-shield-alt mr-3"></i> Sécurité
                            </a>
                        </nav>
                    </div>
                </div>
                
                <!-- Contenu principal -->
                <div class="lg:col-span-3">
                    <!-- En-tête du profil -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                        <div class="p-6 flex flex-col md:flex-row items-center md:items-start">
                            <div class="mb-6 md:mb-0 md:mr-6">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="h-32 w-32 rounded-full border-4 border-white shadow-lg object-cover">
                            </div>
                            <div class="text-center md:text-left flex-1">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <h1 class="text-2xl font-bold text-gray-900">Jean Dupont</h1>
                                        <div class="flex items-center justify-center md:justify-start mt-1">
                                            <span class="text-gray-600">@jdupont</span>
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i> Vérifié
                                            </span>
                                        </div>
                                    </div>
                                    <button id="edit-profile-btn" class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="fas fa-edit mr-2"></i> Modifier
                                    </button>
                                </div>
                                <p class="mt-4 text-gray-700 max-w-2xl">
                                    Développeur full-stack passionné par les nouvelles technologies. J'aime le café, le code et les randonnées en montagne. Actuellement en recherche de nouveaux défis techniques.
                                </p>
                                <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <div class="text-center">
                                        <p class="text-sm text-gray-500">Connexions</p>
                                        <p class="text-xl font-bold text-gray-900">127</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-sm text-gray-500">Membre depuis</p>
                                        <p class="text-xl font-bold text-gray-900">Mars 2023</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-sm text-gray-500">Activité</p>
                                        <p class="text-xl font-bold text-gray-900">Élevée</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-sm text-gray-500">Statut</p>
                                        <p class="text-xl font-bold text-green-600">En ligne</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Suggestions de connexion -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-users mr-2 text-indigo-600"></i> Suggestions de connexion
                            </h2>
                            <p class="text-gray-600 mt-1">Découvrez des membres avec des intérêts similaires</p>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Carte utilisateur 1 -->
                                <div class="user-card bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex items-start">
                                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Avatar" class="h-16 w-16 rounded-full border-2 border-white shadow object-cover">
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h3 class="font-bold text-gray-900">Marie Lambert</h3>
                                                    <div class="flex items-center mt-1">
                                                        <span class="text-gray-600 text-sm">@mlambert</span>
                                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            <i class="fas fa-check-circle mr-1"></i> Vérifié
                                                        </span>
                                                    </div>
                                                </div>
                                                <button class="text-indigo-600 hover:text-indigo-800">
                                                    <i class="fas fa-user-plus"></i>
                                                </button>
                                            </div>
                                            <p class="mt-2 text-gray-700 text-sm">Designer UX passionnée par le design centré sur l'utilisateur et les interfaces intuitives.</p>
                                            <div class="mt-3 flex flex-wrap gap-2">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">UI/UX</span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Figma</span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800">Design</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Carte utilisateur 2 -->
                                <div class="user-card bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex items-start">
                                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Avatar" class="h-16 w-16 rounded-full border-2 border-white shadow object-cover">
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h3 class="font-bold text-gray-900">Thomas Martin</h3>
                                                    <div class="flex items-center mt-1">
                                                        <span class="text-gray-600 text-sm">@tmartin</span>
                                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            <i class="fas fa-check-circle mr-1"></i> Vérifié
                                                        </span>
                                                    </div>
                                                </div>
                                                <button class="text-indigo-600 hover:text-indigo-800">
                                                    <i class="fas fa-user-plus"></i>
                                                </button>
                                            </div>
                                            <p class="mt-2 text-gray-700 text-sm">Product Manager avec 8 ans d'expérience dans la gestion de produits digitaux innovants.</p>
                                            <div class="mt-3 flex flex-wrap gap-2">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Product</span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Agile</span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">Strategy</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Page de recherche -->
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
        
        <!-- Page de profil -->
        <div id="profile-page" class="page hidden animate-fadeIn">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Mon profil</h1>
                <p class="text-gray-600 mt-2">Visualisez et gérez vos informations personnelles</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Informations principales -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-id-card mr-2 text-indigo-600"></i> Informations personnelles
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Nom complet</p>
                                    <p class="mt-1 text-lg font-medium text-gray-900">Jean Dupont</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Pseudo</p>
                                    <div class="mt-1 flex items-center">
                                        <p class="text-lg font-medium text-gray-900">@jdupont</p>
                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i> Unique
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Email</p>
                                    <div class="mt-1 flex items-center">
                                        <p class="text-lg font-medium text-gray-900">jean.dupont@example.com</p>
                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i> Vérifié
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Téléphone</p>
                                    <p class="mt-1 text-lg font-medium text-gray-900">+33 6 12 34 56 78</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-sm font-medium text-gray-500">Bio</p>
                                    <p class="mt-1 text-gray-700">
                                        Développeur full-stack passionné par les nouvelles technologies. J'aime le café, le code et les randonnées en montagne. Actuellement en recherche de nouveaux défis techniques.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Activité récente -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden mt-8">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-history mr-2 text-indigo-600"></i> Activité récente
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <i class="fas fa-search text-indigo-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Vous avez recherché "designer UX"</p>
                                        <p class="text-sm text-gray-500">Il y a 2 heures</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                            <i class="fas fa-user-check text-green-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Vous avez connecté avec Marie Lambert</p>
                                        <p class="text-sm text-gray-500">Il y a 1 jour</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-edit text-blue-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Vous avez mis à jour votre bio</p>
                                        <p class="text-sm text-gray-500">Il y a 3 jours</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Statistiques et actions -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-chart-bar mr-2 text-indigo-600"></i> Statistiques
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-6">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Connexions</p>
                                    <p class="mt-1 text-3xl font-bold text-gray-900">127</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Vues du profil</p>
                                    <p class="mt-1 text-3xl font-bold text-gray-900">548</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Membre depuis</p>
                                    <p class="mt-1 text-2xl font-bold text-gray-900">15 Mars 2023</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-cog mr-2 text-indigo-600"></i> Actions rapides
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                <button data-page="edit-profile" class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg text-left hover:bg-gray-50 transition-colors">
                                    <span class="font-medium text-gray-700">
                                        <i class="fas fa-edit mr-2 text-indigo-600"></i> Modifier le profil
                                    </span>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </button>
                                <button data-page="change-password" class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg text-left hover:bg-gray-50 transition-colors">
                                    <span class="font-medium text-gray-700">
                                        <i class="fas fa-key mr-2 text-indigo-600"></i> Changer mot de passe
                                    </span>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </button>
                                <button data-page="security" class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg text-left hover:bg-gray-50 transition-colors">
                                    <span class="font-medium text-gray-700">
                                        <i class="fas fa-shield-alt mr-2 text-indigo-600"></i> Paramètres de sécurité
                                    </span>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </button>
                                <button class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg text-left hover:bg-gray-50 transition-colors">
                                    <span class="font-medium text-gray-700">
                                        <i class="fas fa-download mr-2 text-indigo-600"></i> Exporter mes données
                                    </span>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Page de modification de profil -->
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
        
        <!-- Page de changement de mot de passe -->
        <div id="change-password-page" class="page hidden animate-fadeIn">
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
                        <form id="change-password-form">
                            <div class="space-y-6">
                                <div>
                                    <label for="current-password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe actuel</label>
                                    <div class="relative">
                                        <input type="password" id="current-password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors" required>
                                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" id="toggle-current-password">
                                            <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="new-password" class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot de passe</label>
                                    <div class="relative">
                                        <input type="password" id="new-password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors" required>
                                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" id="toggle-new-password">
                                            <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                                        </button>
                                    </div>
                                    <div class="mt-4">
                                        <p class="text-sm font-medium text-gray-700 mb-2">Force du mot de passe</p>
                                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div id="password-strength-bar" class="password-strength-bar h-full bg-red-500 w-1/4"></div>
                                        </div>
                                        <p id="password-strength-text" class="mt-1 text-sm text-red-500">Faible</p>
                                    </div>
                                    <ul class="mt-3 text-sm text-gray-500 space-y-1">
                                        <li id="length-requirement" class="flex items-center">
                                            <i class="fas fa-times text-red-500 mr-2"></i>
                                            <span>Au moins 8 caractères</span>
                                        </li>
                                        <li id="uppercase-requirement" class="flex items-center">
                                            <i class="fas fa-times text-red-500 mr-2"></i>
                                            <span>Au moins une majuscule</span>
                                        </li>
                                        <li id="number-requirement" class="flex items-center">
                                            <i class="fas fa-times text-red-500 mr-2"></i>
                                            <span>Au moins un chiffre</span>
                                        </li>
                                        <li id="special-requirement" class="flex items-center">
                                            <i class="fas fa-times text-red-500 mr-2"></i>
                                            <span>Au moins un caractère spécial</span>
                                        </li>
                                    </ul>
                                </div>
                                
                                <div>
                                    <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-1">Confirmer le nouveau mot de passe</label>
                                    <div class="relative">
                                        <input type="password" id="confirm-password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors" required>
                                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" id="toggle-confirm-password">
                                            <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                                        </button>
                                    </div>
                                    <p id="password-match" class="mt-2 text-sm"></p>
                                </div>
                            </div>
                            
                            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                                <button type="button" data-page="profile" class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                    Annuler
                                </button>
                                <button type="submit" class="px-6 py-3 border border-transparent rounded-lg font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                    Changer le mot de passe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mt-8">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-shield-alt mr-2 text-indigo-600"></i> Conseils de sécurité
                        </h2>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                <span>Utilisez un mot de passe unique que vous n'utilisez nulle part ailleurs</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                <span>Évitez les informations personnelles comme votre date de naissance ou votre nom</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                <span>Changez votre mot de passe régulièrement (tous les 3-6 mois)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                <span>Activez la vérification en deux étapes pour plus de sécurité</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Page de sécurité -->
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
                    
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden mt-8">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-laptop mr-2 text-indigo-600"></i> Sessions actives
                            </h2>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-4">Voici les appareils sur lesquels vous êtes actuellement connecté. Si vous ne reconnaissez pas une session, vous pouvez la fermer.</p>
                            
                            <div class="space-y-4">
                                <!-- Session actuelle -->
                                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <i class="fas fa-laptop text-indigo-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <p class="font-medium text-gray-900">Chrome sur Windows</p>
                                            <p class="text-sm text-gray-500">Paris, France • Session actuelle</p>
                                            <p class="text-xs text-gray-400">Connecté le 27/01/2024 à 14:30</p>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Actuelle
                                    </span>
                                </div>
                                
                                <!-- Autre session -->
                                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                            <i class="fas fa-mobile-alt text-gray-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <p class="font-medium text-gray-900">iPhone 13 - Safari</p>
                                            <p class="text-sm text-gray-500">Lyon, France</p>
                                            <p class="text-xs text-gray-400">Connecté le 26/01/2024 à 09:15</p>
                                        </div>
                                    </div>
                                    <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                        Terminer
                                    </button>
                                </div>
                                
                                <!-- Autre session -->
                                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                            <i class="fas fa-tablet-alt text-gray-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <p class="font-medium text-gray-900">iPad - Safari</p>
                                            <p class="text-sm text-gray-500">Marseille, France</p>
                                            <p class="text-xs text-gray-400">Connecté le 25/01/2024 à 18:45</p>
                                        </div>
                                    </div>
                                    <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                        Terminer
                                    </button>
                                </div>
                            </div>
                            
                            <button class="w-full mt-6 px-4 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                <i class="fas fa-sign-out-alt mr-2"></i> Terminer toutes les autres sessions
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-history mr-2 text-indigo-600"></i> Historique de connexion
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Dernière connexion</p>
                                    <p class="mt-1 text-lg font-medium text-gray-900">Aujourd'hui, 14:30</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Lieu</p>
                                    <p class="mt-1 text-lg font-medium text-gray-900">Paris, France</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Appareil</p>
                                    <p class="mt-1 text-lg font-medium text-gray-900">Chrome sur Windows</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">IP</p>
                                    <p class="mt-1 text-lg font-medium text-gray-900">192.168.1.1</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden mt-8">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2 text-indigo-600"></i> Alertes de sécurité
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 rounded-full bg-red-100 flex items-center justify-center">
                                            <i class="fas fa-exclamation text-red-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">2FA non activée</p>
                                        <p class="text-sm text-gray-500">Activez la vérification en deux étapes pour plus de sécurité.</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                            <i class="fas fa-check text-green-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Email vérifié</p>
                                        <p class="text-sm text-gray-500">Votre adresse email est vérifiée.</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 rounded-full bg-yellow-100 flex items-center justify-center">
                                            <i class="fas fa-clock text-yellow-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Mot de passe ancien</p>
                                        <p class="text-sm text-gray-500">Votre mot de passe a plus de 6 mois.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Page de connexion -->
        
        
        <!-- Page d'inscription -->
        
        
        <!-- Page de récupération de mot de passe -->
       
    </main>

    <!-- Footer -->
    <footer id="main-footer" class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-2 mb-4 md:mb-0">
                    <i class="fas fa-link text-indigo-600 text-xl"></i>
                    <span class="text-xl font-bold text-indigo-600">LINKUP</span>
                </div>
                <div class="flex space-x-6 mb-4 md:mb-0">
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors">À propos</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors">Confidentialité</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors">Conditions</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors">Contact</a>
                </div>
                <div class="text-gray-500 text-sm">
                    &copy; 2024 LINKUP. Tous droits réservés.
                </div>
            </div>
        </div>
    </footer>

    <script>
        // État de l'application
        const appState = {
            isLoggedIn: true,
            currentPage: 'home',
            users: [
                {
                    id: 1,
                    name: "Marie Lambert",
                    username: "@mlambert",
                    email: "marie.lambert@example.com",
                    bio: "Passionnée par le design centré sur l'utilisateur et les interfaces intuitives.",
                    avatar: "https://randomuser.me/api/portraits/women/44.jpg",
                    verified: true,
                    role: "Designer UX",
                    tags: ["UI/UX", "Figma", "Design"]
                },
                {
                    id: 2,
                    name: "Thomas Martin",
                    username: "@tmartin",
                    email: "thomas.martin@example.com",
                    bio: "Spécialiste en gestion de produits digitaux avec 8 ans d'expérience.",
                    avatar: "https://randomuser.me/api/portraits/men/22.jpg",
                    verified: true,
                    role: "Product Manager",
                    tags: ["Product", "Agile", "Strategy"]
                },
                {
                    id: 3,
                    name: "Sophie Bernard",
                    username: "@sbernard",
                    email: "sophie.bernard@example.com",
                    bio: "Développeuse front-end spécialisée en React et Vue.js.",
                    avatar: "https://randomuser.me/api/portraits/women/33.jpg",
                    verified: false,
                    role: "Développeuse Front-end",
                    tags: ["React", "Vue.js", "JavaScript"]
                },
                {
                    id: 4,
                    name: "Alexandre Petit",
                    username: "@apetit",
                    email: "alexandre.petit@example.com",
                    bio: "Consultant en transformation digitale pour les PME.",
                    avatar: "https://randomuser.me/api/portraits/men/55.jpg",
                    verified: true,
                    role: "Consultant Digital",
                    tags: ["Transformation", "PME", "Consulting"]
                },
                {
                    id: 5,
                    name: "Julie Moreau",
                    username: "@jmoreau",
                    email: "julie.moreau@example.com",
                    bio: "Marketing digital et réseaux sociaux. Passionnée de photographie.",
                    avatar: "https://randomuser.me/api/portraits/women/22.jpg",
                    verified: false,
                    role: "Responsable Marketing",
                    tags: ["Marketing", "Social Media", "Photography"]
                },
                {
                    id: 6,
                    name: "Lucas Dubois",
                    username: "@ldubois",
                    email: "lucas.dubois@example.com",
                    bio: "Data Scientist passionné par le machine learning et l'analyse de données.",
                    avatar: "https://randomuser.me/api/portraits/men/65.jpg",
                    verified: true,
                    role: "Data Scientist",
                    tags: ["Python", "ML", "Data Analysis"]
                }
            ]
        };

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            // Afficher la page appropriée selon l'état de connexion
            if (!appState.isLoggedIn) {
                showLoginPage();
            } else {
                showPage(appState.currentPage);
            }
            
            // Configurer les écouteurs d'événements
            setupEventListeners();
            
            // Remplir les résultats de recherche
            populateSearchResults();
        });

        // Configuration des écouteurs d'événements
        function setupEventListeners() {
            // Navigation principale
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (appState.isLoggedIn) {
                        const page = e.currentTarget.getAttribute('data-page');
                        showPage(page === 'settings' ? 'edit-profile' : page);
                    } else {
                        showLoginPage();
                    }
                });
            });
            
            // Navigation mobile
            document.querySelectorAll('.mobile-nav-link').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (appState.isLoggedIn) {
                        const page = e.currentTarget.getAttribute('data-page');
                        showPage(page === 'settings' ? 'edit-profile' : page);
                        document.getElementById('mobile-menu').classList.add('hidden');
                    } else {
                        showLoginPage();
                    }
                });
            });
            
            // Menu mobile
            document.getElementById('mobile-menu-button').addEventListener('click', () => {
                const mobileMenu = document.getElementById('mobile-menu');
                mobileMenu.classList.toggle('hidden');
            });
            
            // Déconnexion
            document.getElementById('logout-btn').addEventListener('click', logout);
            document.getElementById('mobile-logout-btn').addEventListener('click', logout);
            
            // Liens de la sidebar
            document.querySelectorAll('.sidebar-link').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const page = e.currentTarget.getAttribute('data-page');
                    
                    // Mettre à jour la classe active
                    document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
                    e.currentTarget.classList.add('active');
                    
                    // Afficher la page correspondante
                    showPage(page);
                });
            });
            
            // Recherche
            document.getElementById('search-btn').addEventListener('click', performSearch);
            document.getElementById('search-input').addEventListener('keyup', (e) => {
                if (e.key === 'Enter') performSearch();
            });
            
            // Filtres de recherche
            document.querySelectorAll('[data-filter]').forEach(filter => {
                filter.addEventListener('click', (e) => {
                    const filterType = e.currentTarget.getAttribute('data-filter');
                    filterSearchResults(filterType);
                });
            });
            
            // Formulaires
            document.getElementById('edit-profile-form').addEventListener('submit', (e) => {
                e.preventDefault();
                showNotification('Votre profil a été mis à jour avec succès.', 'success');
            });
            
            document.getElementById('change-password-form').addEventListener('submit', (e) => {
                e.preventDefault();
                const currentPassword = document.getElementById('current-password').value;
                const newPassword = document.getElementById('new-password').value;
                const confirmPassword = document.getElementById('confirm-password').value;
                
                if (newPassword !== confirmPassword) {
                    showNotification('Les mots de passe ne correspondent pas.', 'error');
                    return;
                }
                
                // Simulation de changement de mot de passe
                showNotification('Votre mot de passe a été changé avec succès.', 'success');
                document.getElementById('change-password-form').reset();
                updatePasswordStrength();
            });
            
            // Authentification
            document.getElementById('login-form').addEventListener('submit', (e) => {
                e.preventDefault();
                appState.isLoggedIn = true;
                showPage('home');
                showNotification('Connexion réussie ! Bienvenue sur LINKUP.', 'success');
            });
            
            document.getElementById('register-form').addEventListener('submit', (e) => {
                e.preventDefault();
                appState.isLoggedIn = true;
                showPage('home');
                showNotification('Compte créé avec succès ! Bienvenue sur LINKUP.', 'success');
            });
            
            document.getElementById('forgot-password-form').addEventListener('submit', (e) => {
                e.preventDefault();
                showNotification('Un email de réinitialisation a été envoyé à votre adresse.', 'success');
            });
            
            // Liens d'authentification
            document.getElementById('register-link').addEventListener('click', (e) => {
                e.preventDefault();
                showPage('register');
            });
            
            document.getElementById('login-link').addEventListener('click', (e) => {
                e.preventDefault();
                showPage('login');
            });
            
            document.getElementById('forgot-password-link').addEventListener('click', (e) => {
                e.preventDefault();
                showPage('forgot-password');
            });
            
            document.getElementById('back-to-login').addEventListener('click', (e) => {
                e.preventDefault();
                showPage('login');
            });
            
            // Téléchargement d'avatar
            document.getElementById('change-avatar-btn').addEventListener('click', () => {
                document.getElementById('avatar-upload').click();
            });
            
            document.getElementById('avatar-upload').addEventListener('change', (e) => {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        document.getElementById('avatar-preview').src = event.target.result;
                        document.getElementById('user-avatar').src = event.target.result;
                    };
                    reader.readAsDataURL(e.target.files[0]);
                    showNotification('Photo de profil mise à jour. N\'oubliez pas d\'enregistrer les modifications.', 'success');
                }
            });
            
            // Supprimer l'avatar
            document.getElementById('remove-avatar-btn').addEventListener('click', () => {
                const defaultAvatar = 'https://randomuser.me/api/portraits/men/32.jpg';
                document.getElementById('avatar-preview').src = defaultAvatar;
                document.getElementById('user-avatar').src = defaultAvatar;
                showNotification('Photo de profil supprimée.', 'success');
            });
            
            // Notification
            document.getElementById('close-notification').addEventListener('click', hideNotification);
            
            // Indicateur de force du mot de passe
            document.getElementById('new-password').addEventListener('input', updatePasswordStrength);
            document.getElementById('register-password').addEventListener('input', updateRegisterPasswordStrength);
            
            // Vérification de la correspondance des mots de passe
            document.getElementById('confirm-password').addEventListener('input', checkPasswordMatch);
            document.getElementById('register-confirm-password').addEventListener('input', checkRegisterPasswordMatch);
            
            // Compteur de bio
            document.getElementById('bio').addEventListener('input', updateBioCounter);
            
            // Boutons d'affichage/masquage de mot de passe
            setupPasswordToggles();
            
            // 2FA
            document.getElementById('enable-2fa-btn').addEventListener('click', () => {
                document.getElementById('2fa-setup').classList.toggle('hidden');
            });
            
            // Boutons d'action rapide
            document.querySelectorAll('[data-page]').forEach(button => {
                if (button.tagName === 'BUTTON' && button.getAttribute('data-page')) {
                    button.addEventListener('click', (e) => {
                        e.preventDefault();
                        const page = e.currentTarget.getAttribute('data-page');
                        showPage(page);
                    });
                }
            });
            
            // Bouton de modification de profil
            document.getElementById('edit-profile-btn').addEventListener('click', (e) => {
                e.preventDefault();
                showPage('edit-profile');
            });
        }

        // Afficher une page spécifique
        function showPage(pageName) {
            // Masquer toutes les pages
            document.querySelectorAll('.page').forEach(page => {
                page.classList.add('hidden');
                page.classList.remove('animate-fadeIn');
            });
            
            // Afficher la page demandée
            const pageElement = document.getElementById(`${pageName}-page`);
            if (pageElement) {
                pageElement.classList.remove('hidden');
                pageElement.classList.add('animate-fadeIn');
                appState.currentPage = pageName;
                
                // Afficher/masquer le header et le footer selon la page
                const isAuthPage = ['login', 'register', 'forgot-password'].includes(pageName);
                document.getElementById('main-header').classList.toggle('hidden', isAuthPage);
                document.getElementById('main-footer').classList.toggle('hidden', isAuthPage);
                
                // Mettre à jour la navigation active
                updateActiveNav(pageName);
                
                // Mettre à jour la sidebar active
                updateActiveSidebar(pageName);
                
                // Initialiser les éléments spécifiques à la page
                if (pageName === 'search') {
                    performSearch();
                }
            }
        }

        // Afficher la page de connexion
        function showLoginPage() {
            appState.isLoggedIn = false;
            showPage('login');
        }

        // Déconnexion
        function logout() {
            appState.isLoggedIn = false;
            showLoginPage();
            showNotification('Vous avez été déconnecté avec succès.', 'success');
        }

        // Mettre à jour la navigation active
        function updateActiveNav(pageName) {
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('text-indigo-600', 'bg-gray-100');
                link.classList.add('text-gray-700');
            });
            
            const activeLink = document.querySelector(`.nav-link[data-page="${pageName === 'edit-profile' || pageName === 'change-password' || pageName === 'security' ? 'settings' : pageName}"]`);
            if (activeLink) {
                activeLink.classList.remove('text-gray-700');
                activeLink.classList.add('text-indigo-600', 'bg-gray-100');
            }
        }

        // Mettre à jour la sidebar active
        function updateActiveSidebar(pageName) {
            document.querySelectorAll('.sidebar-link').forEach(link => {
                link.classList.remove('active');
            });
            
            let activeSidebarId = '';
            if (pageName === 'home') activeSidebarId = 'home';
            else if (pageName === 'profile') activeSidebarId = 'profile';
            else if (pageName === 'search') activeSidebarId = 'search';
            else if (pageName === 'edit-profile') activeSidebarId = 'edit-profile';
            else if (pageName === 'change-password') activeSidebarId = 'change-password';
            else if (pageName === 'security') activeSidebarId = 'security';
            
            const activeSidebarLink = document.querySelector(`.sidebar-link[data-page="${activeSidebarId}"]`);
            if (activeSidebarLink) {
                activeSidebarLink.classList.add('active');
            }
        }

        // Remplir les résultats de recherche
        function populateSearchResults() {
            const searchResults = document.getElementById('search-results');
            const noResults = document.getElementById('no-results');
            
            if (appState.users.length === 0) {
                searchResults.classList.add('hidden');
                noResults.classList.remove('hidden');
                return;
            }
            
            searchResults.classList.remove('hidden');
            noResults.classList.add('hidden');
            searchResults.innerHTML = '';
            
            appState.users.forEach(user => {
                const userCard = createUserCard(user);
                searchResults.appendChild(userCard);
            });
        }

        // Créer une carte utilisateur
        function createUserCard(user) {
            const card = document.createElement('div');
            card.className = 'user-card bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow';
            card.innerHTML = `
                <div class="flex items-start">
                    <img src="${user.avatar}" alt="Avatar" class="h-16 w-16 rounded-full border-2 border-white shadow object-cover">
                    <div class="ml-4 flex-1">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="font-bold text-gray-900">${user.name}</h3>
                                <div class="flex items-center mt-1">
                                    <span class="text-gray-600 text-sm">${user.username}</span>
                                    ${user.verified ? '<span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800"><i class="fas fa-check-circle mr-1"></i> Vérifié</span>' : ''}
                                </div>
                            </div>
                            <button class="text-indigo-600 hover:text-indigo-800">
                                <i class="fas fa-user-plus"></i>
                            </button>
                        </div>
                        <p class="mt-2 text-gray-700 text-sm">${user.bio}</p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            ${user.tags.map(tag => `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">${tag}</span>`).join('')}
                        </div>
                    </div>
                </div>
            `;
            return card;
        }

        // Effectuer une recherche
        function performSearch() {
            const searchInput = document.getElementById('search-input').value.toLowerCase();
            const searchResults = document.getElementById('search-results');
            const noResults = document.getElementById('no-results');
            
            if (!searchInput.trim()) {
                populateSearchResults();
                return;
            }
            
            const filteredUsers = appState.users.filter(user => 
                user.username.toLowerCase().includes(searchInput) || 
                user.email.toLowerCase().includes(searchInput) ||
                user.name.toLowerCase().includes(searchInput) ||
                user.role.toLowerCase().includes(searchInput) ||
                user.tags.some(tag => tag.toLowerCase().includes(searchInput))
            );
            
            searchResults.innerHTML = '';
            
            if (filteredUsers.length === 0) {
                searchResults.classList.add('hidden');
                noResults.classList.remove('hidden');
                return;
            }
            
            searchResults.classList.remove('hidden');
            noResults.classList.add('hidden');
            
            filteredUsers.forEach(user => {
                const userCard = createUserCard(user);
                searchResults.appendChild(userCard);
            });
        }

        // Filtrer les résultats de recherche
        function filterSearchResults(filterType) {
            const searchResults = document.getElementById('search-results');
            const noResults = document.getElementById('no-results');
            
            let filteredUsers = appState.users;
            
            if (filterType === 'verified') {
                filteredUsers = filteredUsers.filter(user => user.verified);
            } else if (filterType !== 'all') {
                filteredUsers = filteredUsers.filter(user => 
                    user.role.toLowerCase().includes(filterType) ||
                    user.tags.some(tag => tag.toLowerCase().includes(filterType))
                );
            }
            
            searchResults.innerHTML = '';
            
            if (filteredUsers.length === 0) {
                searchResults.classList.add('hidden');
                noResults.classList.remove('hidden');
                return;
            }
            
            searchResults.classList.remove('hidden');
            noResults.classList.add('hidden');
            
            filteredUsers.forEach(user => {
                const userCard = createUserCard(user);
                searchResults.appendChild(userCard);
            });
        }

        // Afficher une notification
        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            const icon = notification.querySelector('i');
            const messageEl = document.getElementById('notification-message');
            
            // Mettre à jour le message
            messageEl.textContent = message;
            
            // Changer la couleur selon le type
            if (type === 'success') {
                icon.className = 'fas fa-check-circle text-green-500 text-xl';
                notification.classList.remove('border-blue-500');
                notification.classList.add('border-green-500');
            } else {
                icon.className = 'fas fa-exclamation-circle text-red-500 text-xl';
                notification.classList.remove('border-blue-500');
                notification.classList.add('border-red-500');
            }
            
            // Afficher la notification
            notification.classList.remove('hidden');
            notification.classList.add('show');
            
            // Masquer automatiquement après 5 secondes
            setTimeout(hideNotification, 5000);
        }

        // Masquer la notification
        function hideNotification() {
            const notification = document.getElementById('notification');
            notification.classList.remove('show');
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 300);
        }

        // Mettre à jour l'indicateur de force du mot de passe
        function updatePasswordStrength() {
            const password = document.getElementById('new-password').value;
            const strengthBar = document.getElementById('password-strength-bar');
            const strengthText = document.getElementById('password-strength-text');
            const requirements = {
                length: document.getElementById('length-requirement'),
                uppercase: document.getElementById('uppercase-requirement'),
                number: document.getElementById('number-requirement'),
                special: document.getElementById('special-requirement')
            };
            
            let strength = 0;
            let text = 'Très faible';
            let color = '#ef4444'; // red-500
            
            // Vérifier les critères
            const hasLength = password.length >= 8;
            const hasUppercase = /[A-Z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            const hasSpecial = /[^A-Za-z0-9]/.test(password);
            
            // Mettre à jour les icônes des critères
            updateRequirementIcon(requirements.length, hasLength);
            updateRequirementIcon(requirements.uppercase, hasUppercase);
            updateRequirementIcon(requirements.number, hasNumber);
            updateRequirementIcon(requirements.special, hasSpecial);
            
            // Calculer la force
            if (hasLength) strength++;
            if (hasUppercase) strength++;
            if (hasNumber) strength++;
            if (hasSpecial) strength++;
            
            // Déterminer le texte et la couleur
            if (strength === 0) {
                text = 'Très faible';
                color = '#ef4444'; // red-500
            } else if (strength === 1) {
                text = 'Faible';
                color = '#f97316'; // orange-500
            } else if (strength === 2) {
                text = 'Moyen';
                color = '#eab308'; // yellow-500
            } else if (strength === 3) {
                text = 'Bon';
                color = '#84cc16'; // lime-500
            } else if (strength === 4) {
                text = 'Très bon';
                color = '#10b981'; // green-500
            }
            
            // Mettre à jour la barre et le texte
            strengthBar.style.width = `${strength * 25}%`;
            strengthBar.style.backgroundColor = color;
            strengthText.textContent = text;
            strengthText.className = 'mt-1 text-sm';
            strengthText.classList.add(`text-${getColorName(color)}-500`);
        }

        // Mettre à jour l'indicateur de force du mot de passe (inscription)
        function updateRegisterPasswordStrength() {
            const password = document.getElementById('register-password').value;
            const strengthBar = document.getElementById('register-password-strength-bar');
            const strengthText = document.getElementById('register-password-strength-text');
            
            let strength = 0;
            let text = 'Très faible';
            let color = '#ef4444';
            
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            if (strength === 0) {
                text = 'Très faible';
                color = '#ef4444';
            } else if (strength === 1) {
                text = 'Faible';
                color = '#f97316';
            } else if (strength === 2) {
                text = 'Moyen';
                color = '#eab308';
            } else if (strength === 3) {
                text = 'Bon';
                color = '#84cc16';
            } else if (strength === 4) {
                text = 'Très bon';
                color = '#10b981';
            }
            
            strengthBar.style.width = `${strength * 25}%`;
            strengthBar.style.backgroundColor = color;
            strengthText.textContent = text;
            strengthText.className = 'mt-1 text-sm';
            strengthText.classList.add(`text-${getColorName(color)}-500`);
        }

        // Mettre à jour l'icône d'une condition
        function updateRequirementIcon(element, isValid) {
            const icon = element.querySelector('i');
            if (isValid) {
                icon.className = 'fas fa-check text-green-500 mr-2';
                element.classList.remove('text-gray-500');
                element.classList.add('text-green-500');
            } else {
                icon.className = 'fas fa-times text-red-500 mr-2';
                element.classList.remove('text-green-500');
                element.classList.add('text-gray-500');
            }
        }

        // Obtenir le nom de la couleur Tailwind à partir de la valeur hex
        function getColorName(hex) {
            const colors = {
                '#ef4444': 'red',
                '#f97316': 'orange',
                '#eab308': 'yellow',
                '#84cc16': 'lime',
                '#10b981': 'green'
            };
            return colors[hex] || 'gray';
        }

        // Vérifier la correspondance des mots de passe
        function checkPasswordMatch() {
            const password = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const matchElement = document.getElementById('password-match');
            
            if (!password || !confirmPassword) {
                matchElement.textContent = '';
                return;
            }
            
            if (password === confirmPassword) {
                matchElement.textContent = 'Les mots de passe correspondent';
                matchElement.className = 'mt-2 text-sm text-green-500';
            } else {
                matchElement.textContent = 'Les mots de passe ne correspondent pas';
                matchElement.className = 'mt-2 text-sm text-red-500';
            }
        }

        // Vérifier la correspondance des mots de passe (inscription)
        function checkRegisterPasswordMatch() {
            const password = document.getElementById('register-password').value;
            const confirmPassword = document.getElementById('register-confirm-password').value;
            const matchElement = document.getElementById('register-password-match');
            
            if (!password || !confirmPassword) {
                matchElement.textContent = '';
                return;
            }
            
            if (password === confirmPassword) {
                matchElement.textContent = 'Les mots de passe correspondent';
                matchElement.className = 'mt-2 text-sm text-green-500';
            } else {
                matchElement.textContent = 'Les mots de passe ne correspondent pas';
                matchElement.className = 'mt-2 text-sm text-red-500';
            }
        }

        // Mettre à jour le compteur de bio
        function updateBioCounter() {
            const bio = document.getElementById('bio').value;
            const counter = document.getElementById('bio-counter');
            const remaining = 500 - bio.length;
            counter.textContent = `${bio.length}/500`;
            
            if (remaining < 0) {
                counter.className = 'font-medium text-red-500';
            } else if (remaining < 50) {
                counter.className = 'font-medium text-yellow-500';
            } else {
                counter.className = 'font-medium text-gray-500';
            }
        }

        // Configurer les boutons d'affichage/masquage de mot de passe
        function setupPasswordToggles() {
            // Page de changement de mot de passe
            document.getElementById('toggle-current-password').addEventListener('click', function() {
                togglePasswordVisibility('current-password', this);
            });
            
            document.getElementById('toggle-new-password').addEventListener('click', function() {
                togglePasswordVisibility('new-password', this);
            });
            
            document.getElementById('toggle-confirm-password').addEventListener('click', function() {
                togglePasswordVisibility('confirm-password', this);
            });
            
            // Page de connexion
            document.getElementById('toggle-login-password').addEventListener('click', function() {
                togglePasswordVisibility('login-password', this);
            });
            
            // Page d'inscription
            document.getElementById('toggle-register-password').addEventListener('click', function() {
                togglePasswordVisibility('register-password', this);
            });
            
            document.getElementById('toggle-register-confirm-password').addEventListener('click', function() {
                togglePasswordVisibility('register-confirm-password', this);
            });
        }

        // Basculer la visibilité du mot de passe
        function togglePasswordVisibility(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'fas fa-eye-slash text-gray-600';
            } else {
                input.type = 'password';
                icon.className = 'fas fa-eye text-gray-400 hover:text-gray-600';
            }
        }
    </script>
</body>
</html>