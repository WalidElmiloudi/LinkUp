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