<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title ?? 'Gestion des Sanctions') ?></title>

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
            shell: '1180px',
            content: '1180px',
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

  <link rel="stylesheet" href="/css/style.css">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #F8FAFC;
    }

    :where(input, a, button, select, textarea):focus-visible {
      outline: 2px solid #2563eb;
      outline-offset: 2px;
    }

    .bg-primary-blue {
      background-color: #2563EB;
    }

    .bg-primary-hover {
      background-color: #1D4ED8;
    }

    .bg-nav-blue {
      background-color: #2563EB;
    }

    .bg-footer-dark {
      background-color: #1E293B;
    }

    .text-primary-blue {
      color: #2563EB;
    }

    .burger-line {
      transition: transform 180ms ease, opacity 180ms ease, background-color 180ms ease;
      transform-origin: center;
    }

    #nav-toggle.open .line-1 {
      transform: translateY(6px) rotate(45deg);
    }

    #nav-toggle.open .line-2 {
      opacity: 0;
    }

    #nav-toggle.open .line-3 {
      transform: translateY(-6px) rotate(-45deg);
    }
  </style>
</head>

<body class="min-h-screen flex flex-col">
  <header class="bg-white border-b border-slate-200 mb-20">
    <div class="mx-auto max-w-content px-5">
      <div class="h-16 flex items-center justify-between">
        <div class="flex items-center gap-2 text-primary-600 font-bold">
          <div class="w-[22px] h-[22px] grid place-items-center border rounded-md text-[11px]">
            📋
          </div>
          <span>Gestion des Sanctions</span>
        </div>
        <div class="text-sm text-slate-500">Application Vie Scolaire</div>
      </div>
    </div>

    <?php if (!empty($_SESSION['user'])): ?>
      <nav class="bg-primary-600 text-white text-sm">
        <div class="mx-auto max-w-content px-5 h-10 flex items-center justify-between">
          <div class="flex items-center gap-4">
            <button id="nav-toggle"
              type="button"
              class="md:hidden inline-flex items-center justify-center rounded-full border border-white/30 bg-primary-600/80 px-2.5 py-2 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-primary-600 focus-visible:ring-white">
              <span class="sr-only">Ouvrir le menu</span>
              <div class="flex flex-col justify-center gap-[4px]">
                <span class="burger-line line-1 block h-[2px] w-6 bg-white rounded-full"></span>
                <span class="burger-line line-2 block h-[2px] w-6 bg-white rounded-full"></span>
                <span class="burger-line line-3 block h-[2px] w-6 bg-white rounded-full"></span>
              </div>
            </button>

            <div class="hidden md:flex items-center gap-6">
              <a href="index.php?action=index" class="inline-flex items-center gap-2 font-semibold">
                <span>🏠</span> <span>Accueil</span>
              </a>
              <a href="index.php?action=dashboard" class="inline-flex items-center gap-2">
                <span>📊</span> <span>Dashboard / Profil</span>
              </a>
              <a href="index.php?action=listeClasse" class="inline-flex items-center gap-2">
                <span>📚</span> <span>Classes</span>
              </a>
              <a href="index.php?action=listeEleve" class="inline-flex items-center gap-2">
                <span>👥</span> <span>Élèves</span>
              </a>
              <a href="index.php?action=sanctions" class="inline-flex items-center gap-2">
                <span>⚖️</span> <span>Sanctions</span>
              </a>
            </div>
          </div>

          <div class="hidden md:flex items-center gap-5">
            <span class="text-sm">
              Bonjour, <?= htmlspecialchars($_SESSION['user']['prenom']) ?>
            </span>
            <a href="index.php?action=deconnexion" class="inline-flex items-center gap-2 font-semibold">
              <span>📕</span> <span>Déconnexion</span>
            </a>
          </div>
        </div>

        <div id="mobile-menu" class="md:hidden border-t border-primary-500/40 hidden">
          <div class="mx-auto max-w-content px-5 py-3 space-y-1">
            <a href="index.php?action=dashboard"
              class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-primary-700/70 transition">
              <span>📊</span> <span>Dashboard / Profil</span>
            </a>
            <a href="index.php?action=listeClasse"
              class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-primary-700/70 transition">
              <span>📚</span> <span>Classes</span>
            </a>
            <a href="index.php?action=eleves"
              class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-primary-700/70 transition">
              <span>👥</span> <span>Élèves</span>
            </a>
            <a href="index.php?action=sanctions"
              class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-primary-700/70 transition">
              <span>⚖️</span> <span>Sanctions</span>
            </a>
            <div class="border-t border-primary-500/40 mt-2 pt-2">
              <div class="flex items-center justify-between px-3 py-1.5 text-xs text-primary-100/80">
                <span>Connecté :</span>
                <span class="font-semibold">
                  <?= htmlspecialchars($_SESSION['user']['prenom']) ?>
                </span>
              </div>
              <a href="index.php?action=deconnexion"
                class="mt-1 flex items-center justify-center gap-2 px-3 py-2 rounded-xl bg-white text-primary-700 font-semibold hover:bg-slate-100 transition">
                <span>📕</span> <span>Déconnexion</span>
              </a>
            </div>
          </div>
        </div>
      </nav>
    <?php else: ?>
      <div class="bg-primary-800 text-primary-100">
        <div class="mx-auto max-w-content px-5 py-2 flex items-center justify-between">
          <a
            class="inline-flex items-center gap-2 rounded-md px-2.5 py-1 text-sm text-white"
            href="index.php?action=index">
            <span>🏠</span> Accueil
          </a>
          <a
            class="text-white inline-flex items-center gap-2 rounded-md px-2.5 py-1 text-sm text-primary-100/90 hover:bg-primary-700/40 transition"
            href="index.php?action=connexion">
            <span>🔐</span> Connexion
          </a>
        </div>
      </div>
    <?php endif; ?>
  </header>

  <main class="flex-1">
    <?php if (isset($error)): ?>
      <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?= $content ?? '' ?>
  </main>

  <footer class="bg-slate-900 text-slate-200 border-t border-white/10 mt-5">
    <div class="mx-auto max-w-content px-5 py-9">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
          <h5 class="font-semibold mb-2">📑 Gestion des Sanctions</h5>
          <p class="text-sm text-slate-300">
            Application de gestion de la vie scolaire pour le suivi des sanctions et incidents.
          </p>
        </div>
        <div>
          <h5 class="font-semibold mb-2">🔗 Liens utiles</h5>
          <ul class="space-y-1 text-sm text-slate-300">
            <li><a class="hover:text-white" href="#">Documentation</a></li>
            <li><a class="hover:text-white" href="#">Support</a></li>
            <li><a class="hover:text-white" href="#">Contact</a></li>
          </ul>
        </div>
        <div>
          <h5 class="font-semibold mb-2">🧾 Informations</h5>
          <p class="text-sm text-slate-300">
            Développé dans le cadre du BTS SIO – Projet CCF 2025
          </p>
        </div>
      </div>
    </div>
  </footer>

  <script>
    (function() {
      const navToggle = document.getElementById('nav-toggle');
      const mobileMenu = document.getElementById('mobile-menu');

      if (!navToggle || !mobileMenu) return;

      const closeMenu = () => {
        mobileMenu.classList.add('hidden');
        navToggle.classList.remove('open');
      };

      const openMenu = () => {
        mobileMenu.classList.remove('hidden');
        navToggle.classList.add('open');
      };

      navToggle.addEventListener('click', () => {
        const isOpen = navToggle.classList.contains('open');
        if (isOpen) {
          closeMenu();
        } else {
          openMenu();
        }
      });

      window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
          closeMenu();
        }
      });

      mobileMenu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
          closeMenu();
        });
      });
    })();
  </script>
</body>

</html>