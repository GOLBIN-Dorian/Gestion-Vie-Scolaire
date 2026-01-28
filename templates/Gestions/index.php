<?php
if (!empty($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  header('Location: index.php?action=dashboard');
  exit;
}
?>



<?php
$title = 'Gestion des Sanctions — Accueil';
ob_start();
?>

<div class="w-full flex flex-col items-center justify-center gap-10">
  <!-- HERO -->
  <section class="w-full">
    <div class="mx-auto max-w-[1600px] rounded-2xl text-white px-8 py-10 shadow-card bg-gradient-to-r from-blue-600 to-blue-800">
      <h1 class="text-4xl sm:text-5xl font-extrabold text-center mb-2">🎓 Application de Gestion des Sanctions</h1>
      <p class="text-lg sm:text-xl text-indigo-100 text-center">Système de gestion de la vie scolaire pour le lycée</p>
    </div>
  </section>

  <!-- CARDS -->
  <section class="w-full grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 max-w-[1600px]">
    <!-- Connexion -->
    <article class="bg-white rounded-2xl shadow p-6 flex flex-col items-center text-center">
      <div class="w-12 h-12 grid place-items-center bg-indigo-50 text-blue-700 rounded-xl border mb-3 text-2xl">🔐</div>
      <h3 class="text-xl font-semibold mb-1">Connexion</h3>
      <p class="text-gray-500 mb-4">Accédez à votre espace personnel pour gérer les sanctions</p>
      <a href="index.php?action=connexion" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl px-4 py-2 shadow">
        Se connecter
      </a>
    </article>

    <!-- Inscription -->
    <article class="bg-white rounded-2xl shadow p-6 flex flex-col items-center text-center">
      <div class="w-12 h-12 grid place-items-center bg-green-50 text-green-700 rounded-xl border mb-3 text-2xl">📝</div>
      <h3 class="text-xl font-semibold mb-1">Créer un compte</h3>
      <p class="text-gray-500 mb-4">Inscrivez-vous pour accéder au système de gestion</p>
      <a href="index.php?action=inscription" class="bg-green-500 hover:bg-green-600 text-white font-medium rounded-xl px-4 py-2 shadow">
        S’inscrire
      </a>
    </article>
  </section>

  <!-- FEATURES -->
  <section class="w-full max-w-[1600px] mt-4 bg-gradient-to-b from-[#f7faff] to-[#f4f8ff] border border-[#e6eefc] rounded-xl p-4 shadow-sm">
    <h2 class="text-center text-[20px] font-bold mb-4">🚀 À propos de l’application</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <!-- Feature 1 -->
      <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-primary-800/5 transition">
        <div class="w-12 h-12 rounded-full grid place-items-center text-lg bg-indigo-50 text-slate-700 border border-slate-200">⚖️</div>
        <div>
          <h4 class="font-semibold text-base mb-1">Gestion des Sanctions</h4>
          <p class="text-sm text-slate-500">
            Enregistrez et suivez les sanctions des élèves de manière efficace
          </p>
        </div>
      </div>
      <!-- Feature 2 -->
      <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-primary-800/5 transition">
        <div class="w-12 h-12 rounded-full grid place-items-center text-lg bg-indigo-50 text-slate-700 border border-slate-200">👥</div>
        <div>
          <h4 class="font-semibold text-base mb-1">Gestion des Élèves</h4>
          <p class="text-sm text-slate-500">
            Centralisez les informations des élèves et leurs classes
          </p>
        </div>
      </div>
      <!-- Feature 3 -->
      <a class="flex items-start gap-4 p-4 rounded-xl hover:bg-primary-800/5 transition">
        <div class="w-12 h-12 rounded-full grid place-items-center text-lg bg-indigo-50 text-slate-700 border border-slate-200">📊</div>
        <div>
          <h4 class="font-semibold text-base mb-1">Tableau de Bord</h4>
          <p class="text-sm text-slate-500">
            Visualisez les statistiques and l’activité récente
          </p>
        </div>
      </a>
    </div>
  </section>
</div>


<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>