<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title ?? 'Gestion des Sanctions') ?></title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            inter: ['Inter', 'ui-sans-serif', 'system-ui']
          },
          colors: {
            primary: {
              600: '#2563eb',
              700: '#1d4ed8',
              800: '#1e40af',
            },
          },
          borderRadius: {
            '2.5xl': '22px'
          },
          maxWidth: {
            shell: '1180px'
          },
          boxShadow: {
            card: '0 10px 28px rgba(2,6,23,.10)',
            input: '0 2px 8px rgba(2,6,23,.06)',
            btn: '0 6px 16px rgba(30,64,175,.25)',
          },
        },
      },
    };
  </script>

  <style>
    body {
      background: #f5f7fb;
    }

    :where(input, a, button, select, textarea):focus-visible {
      outline: 2px solid #2563eb;
      outline-offset: 2px;
    }
  </style>
</head>

<body>
  <header class="bg-white border-b border-slate-200 mb-20">
    <div class="mx-auto max-w-content px-5">
      <div class="h-16 flex items-center justify-between">
        <!-- Branding gauche -->
        <div class="flex items-center gap-2 text-primary-600 font-bold">
          <div class="w-[22px] h-[22px] grid place-items-center border rounded-md text-[11px]">📋</div>
          <span>Gestion des Sanctions</span>
        </div>
        <!-- Nom d'appli à droite -->
        <div class="text-sm text-slate-500">Application Vie Scolaire</div>
      </div>
    </div>
    <!-- Ruban / fil d'Ariane -->
    <div class="bg-primary-800 text-primary-100">
      <div class="mx-auto max-w-content px-5 py-2">
        <a class="inline-flex items-center gap-2 rounded-md px-2.5 py-1 text-sm text-white" href="index.php?action=index">
          <span>🏠</span> Accueil
        </a>
      </div>
    </div>
  </header>


  <main>
    <?php if (isset($error)): ?>
      <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
      <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?= $content ?? '' ?>
  </main>

  <footer class="bg-slate-900 text-slate-200 border-t border-white/10 mt-5">
    <div class="mx-auto max-w-content px-5 py-9">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Col 1 -->
        <div>
          <h5 class="font-semibold mb-2">📑 Gestion des Sanctions</h5>
          <p class="text-sm text-slate-300">
            Application de gestion de la vie scolaire pour le suivi des sanctions et incidents.
          </p>
        </div>
        <!-- Col 2 -->
        <div>
          <h5 class="font-semibold mb-2">🔗 Liens utiles</h5>
          <ul class="space-y-1 text-sm text-slate-300">
            <li><a class="hover:text-white" href="#">Documentation</a></li>
            <li><a class="hover:text-white" href="#">Support</a></li>
            <li><a class="hover:text-white" href="#">Contact</a></li>
          </ul>
        </div>
        <!-- Col 3 -->
        <div>
          <h5 class="font-semibold mb-2">🧾 Informations</h5>
          <p class="text-sm text-slate-300">
            Développé dans le cadre du BTS SIO – Projet CCF 2025
          </p>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>
<?php
