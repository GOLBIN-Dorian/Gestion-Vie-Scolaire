<?php

$title = 'Gestion des Sanctions — Dashboard';
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($success_dashboard)) {
    $success_dashboard = null;
}
?>


<div class="max-w-7xl mx-auto space-y-6">
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="mt-4">
            <div class="flex items-start gap-3 p-4 rounded-[16px] border border-green-300 shadow-card bg-gradient-to-r from-green-50 to-green-100/60">
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-green-600 text-white text-[18px]">
                    ✔
                </div>
                <div class="text-green-800 text-[14.6px] font-medium leading-snug">
                    <?= htmlspecialchars($_SESSION['success_message']) ?>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-8 rounded-xl shadow-lg">
        <div class="flex items-center space-x-4 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-yellow-300">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
            </svg>
            <div>
                <h2 class="text-3xl font-bold">Bienvenue, <?= htmlspecialchars($nom . " " . $prenom) ?> !</h2>
                <p class="text-blue-200">Tableau de bord de gestion des sanctions scolaires</p>
            </div>
        </div>
        <div class="flex flex-wrap gap-3 mt-6">
            <a href="index.php?action=listeSanction">
                <button class="flex items-center justify-center space-x-2 bg-white text-blue-600 font-semibold px-5 py-2.5 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.153.34c-1.325 0-2.56-.5-3.5-1.372M6.75 4.97A48.416 48.416 0 0 1 12 4.5c2.291 0 4.545.16 6.75.47m-13.5 0c-1.01.143-2.01.317-3 .52m3-.52L3.63 15.69c-.122.499.106 1.028.589 1.202a5.989 5.989 0 0 0 2.153.34c1.325 0 2.56-.5 3.5-1.372" />
                    </svg>
                    <span>Gérer les Sanctions</span>

                </button>
            </a>
            <a href="index.php?action=listeEleve">
                <button class="flex items-center justify-center space-x-2 bg-blue-500 text-white font-semibold px-5 py-2.5 rounded-lg hover:bg-blue-400 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-2.253M15 19.128v-3.873M15 19.128A9.371 9.371 0 0 1 12 21c-2.676 0-5.14-1.257-6.75-3.252M15 15.255A9.371 9.371 0 0 0 12 17.25c-2.676 0-5.14-1.257-6.75-3.252m0 0A9.37 9.37 0 0 1 12 13.5c2.676 0 5.14 1.257 6.75 3.252m0 0v-3.873m0 0a9.37 9.37 0 0 0-6.75-3.252M12 13.5A9.37 9.37 0 0 1 18.75 10.5m-13.5 0A9.37 9.37 0 0 1 12 13.5m-6.75 0V10.5a9.37 9.37 0 0 1 13.5 0v3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.375c0 .621.504 1.125 1.125 1.125h3.375c.621 0 1.125-.504 1.125-1.125V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                    </svg>
                    <span>Voir les Élèves</span>
                </button>
            </a>
            <a href="index.php?action=listeClasse"><button class="flex items-center justify-center space-x-2 bg-purple-500 text-white font-semibold px-5 py-2.5 rounded-lg hover:bg-purple-400 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                    </svg>
                    <span>Gérer les Classes</span>

                </button>
            </a>
            <button class="flex items-center justify-center space-x-2 bg-red-500 text-white font-semibold px-5 py-2.5 rounded-lg hover:bg-red-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
                </svg>
                <a href="index.php?action=deconnexion"><span>Déconnexion</span></a>
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-blue-500 flex items-center space-x-4">
            <div class="p-3 bg-gray-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.153.34c-1.325 0-2.56-.5-3.5-1.372M6.75 4.97A48.416 48.416 0 0 1 12 4.5c2.291 0 4.545.16 6.75.47m-13.5 0c-1.01.143-2.01.317-3 .52m3-.52L3.63 15.69c-.122.499.106 1.028.589 1.202a5.989 5.989 0 0 0 2.153.34c1.325 0 2.56-.5 3.5-1.372" />
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total Sanctions</p>
                <p class="text-2xl font-bold text-gray-800">0</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-green-500 flex items-center space-x-4">
            <div class="p-3 bg-gray-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-2.253M15 19.128v-3.873M15 19.128A9.371 9.371 0 0 1 12 21c-2.676 0-5.14-1.257-6.75-3.252M15 15.255A9.371 9.371 0 0 0 12 17.25c-2.676 0-5.14-1.257-6.75-3.252m0 0A9.37 9.37 0 0 1 12 13.5c2.676 0 5.14 1.257 6.75 3.252m0 0v-3.873m0 0a9.37 9.37 0 0 0-6.75-3.252M12 13.5A9.37 9.37 0 0 1 18.75 10.5m-13.5 0A9.37 9.37 0 0 1 12 13.5m-6.75 0V10.5a9.37 9.37 0 0 1 13.5 0v3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.375c0 .621.504 1.125 1.125 1.125h3.375c.621 0 1.125-.504 1.125-1.125V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total Eleves</p>
                <p class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($totalEleves, ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-purple-500 flex items-center space-x-4">
            <div class="p-3 bg-gray-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-purple-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total Professeurs</p>
                <p class="text-2xl font-bold text-gray-800">0</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-orange-500 flex items-center space-x-4">
            <div class="p-3 bg-gray-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-orange-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total Classes</p>
                <p class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($totalClasses, ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        </div>
    </div>

    <!-- Main Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Quick Access -->
        <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm">
            <div class="flex items-center space-x-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-yellow-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                </svg>
                <h3 class="text-xl font-bold text-gray-800">Accès Rapide</h3>
            </div>
            <div class="space-y-2">
                <a href="index.php?action=creationSanction" class="flex items-center space-x-4 p-4 hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="p-3 rounded-lg bg-red-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Nouvelle Sanction</p>
                        <p class="text-sm text-gray-500">Enregistrer un nouvel incident</p>
                    </div>
                </a>
                <div class="border-t border-gray-100"></div>
                <a href="index.php?action=creationEleve" class="flex items-center space-x-4 p-4 hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="p-3 rounded-lg bg-blue-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Nouvel Élève</p>
                        <p class="text-sm text-gray-500">Ajouter un élève au système</p>
                    </div>
                </a>
                <div class="border-t border-gray-100"></div>
                <a href="index.php?action=creationProfesseur" class="flex items-center space-x-4 p-4 hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="p-3 rounded-lg bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Nouveau Professeur</p>
                        <p class="text-sm text-gray-500">Enregistrer un enseignant</p>
                    </div>
                </a>
                <div class="border-t border-gray-100"></div>
                <a href="index.php?action=creationClasse" class="flex items-center space-x-4 p-4 hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="p-3 rounded-lg bg-purple-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-purple-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Nouvelle Classe</p>
                        <p class="text-sm text-gray-500">Créer une nouvelle classe</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- User Info -->
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <div class="flex items-center space-x-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <h3 class="text-xl font-bold text-gray-800">Informations Utilisateur</h3>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center space-x-4">
                        <div class="p-2 bg-gray-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                        <span class="text-sm text-gray-500">Nom complet</span>
                    </div>
                    <span class="text-sm font-medium text-gray-800"><?= htmlspecialchars($nom . " " . $prenom) ?></span>
                </div>
                <div class="border-t border-gray-100 mx-4"></div>
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center space-x-4">
                        <div class="p-2 bg-gray-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <span class="text-sm text-gray-500">Email</span>
                    </div>
                    <span class="text-sm font-medium text-gray-800"><?= htmlspecialchars($email) ?></span>
                </div>
                <div class="border-t border-gray-100 mx-4"></div>
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center space-x-4">
                        <div class="p-2 bg-gray-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.075a2.25 2.25 0 0 1-2.25 2.25h-12a2.25 2.25 0 0 1-2.25-2.25V14.15M16.5 6.75v-1.5a2.25 2.25 0 0 0-2.25-2.25h-4.5a2.25 2.25 0 0 0-2.25 2.25v1.5M18.75 14.15v-6.375c0-1.24-1.01-2.25-2.25-2.25h-9c-1.24 0-2.25 1.01-2.25 2.25v6.375" />
                            </svg>
                        </div>
                        <span class="text-sm text-gray-500">Service</span>
                    </div>
                    <span class="text-sm font-medium text-purple-600">Vie Scolaire</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Start Guide -->
    <div class="bg-gray-50 p-8 rounded-xl border border-gray-200">
        <div class="flex items-center space-x-2 mb-8 justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-gray-800">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.63 2.25a14.98 14.98 0 0 0-12.12 6.16.035.035 0 0 0 .02.055l3.478 3.479a6 6 0 0 1 7.38 5.84m-7.38 0a6 6 0 0 1-5.84-7.38L2.25 9.63a14.98 14.98 0 0 0 6.16 12.12 14.98 14.98 0 0 0 12.12-6.16" />
            </svg>
            <h3 class="text-2xl font-bold text-gray-800 text-center">Guide de Démarrage Rapide</h3>
        </div>
        <div class="flex flex-wrap justify-center md:justify-around items-start gap-8">
            <div class="text-center flex-1 min-w-[200px]">
                <div class="mx-auto bg-blue-100 text-blue-600 font-bold w-12 h-12 flex items-center justify-center rounded-full mb-4">1</div>
                <h4 class="font-bold text-gray-800 mb-2">Configurez les Classes</h4>
                <p class="text-sm text-gray-500">Créez les classes de votre établissement pour organiser les élèves</p>
            </div>
            <div class="text-center flex-1 min-w-[200px]">
                <div class="mx-auto bg-blue-100 text-blue-600 font-bold w-12 h-12 flex items-center justify-center rounded-full mb-4">2</div>
                <h4 class="font-bold text-gray-800 mb-2">Ajoutez les Élèves</h4>
                <p class="text-sm text-gray-500">Enregistrez les élèves et associez-les à leurs classes respectives</p>
            </div>
            <div class="text-center flex-1 min-w-[200px]">
                <div class="mx-auto bg-blue-100 text-blue-600 font-bold w-12 h-12 flex items-center justify-center rounded-full mb-4">3</div>
                <h4 class="font-bold text-gray-800 mb-2">Gérez les Sanctions</h4>
                <p class="text-sm text-gray-500">Enregistrez et suivez les sanctions des élèves de manière efficace</p>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>