<?php
$title = 'Gestion des Sanctions — Inscription';
ob_start();
?>


<div class="mx-auto max-w-shell px-5 w-full">

  <section class="mt-8 md:mt-10">
    <div
      class="mx-auto max-w-[1040px] rounded-[18px] md:rounded-[20px] text-white px-8 md:px-12 py-10 md:py-12 shadow-card"
      style="background:linear-gradient(135deg,#18a04b 0%, #178a44 55%, #166c37 100%);">
      <h1 class="flex items-center justify-center gap-3 text-[30px] md:text-[36px] font-extrabold tracking-tight">
        <span class="text-[30px] md:text-[36px]">📝</span> Créer un compte
      </h1>
      <p class="mt-2 text-center text-emerald-50/95 text-[15px] md:text-[16px]">
        Inscrivez-vous pour accéder au système de gestion
      </p>
    </div>
  </section>

  <!-- FORM CARD -->
  <section class="flex items-center justify-center mt-10">
    <div class="w-full max-w-[720px]">
      <?php if (!empty($success_message)): ?>
        <!-- Message de succès -->
        <div class="w-full bg-emerald-50 border border-emerald-200 rounded-[20px] shadow-card px-6 md:px-8 py-6 md:py-8 mb-6">
          <h2 class="text-[20px] font-semibold text-emerald-800 mb-2">
            🎉 Compte créé avec succès
          </h2>
          <p class="text-[14px] text-emerald-800 mb-4">
            <?php echo htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8'); ?>
          </p>
        </div>
      <?php endif; ?>

      <?php if (!empty($errors['general'])): ?>
        <!-- Message d'erreur général -->
        <div class="w-full bg-red-50 border border-red-200 rounded-[20px] shadow-card px-6 md:px-8 py-6 md:py-8 mb-6">
          <h2 class="text-[20px] font-semibold text-red-800 mb-2">
            ⚠️ Erreur lors de l'inscription
          </h2>
          <p class="text-[14px] text-red-800">
            <?php echo htmlspecialchars($errors['general'], ENT_QUOTES, 'UTF-8'); ?>
          </p>
        </div>
      <?php endif; ?>

      <form method="POST" action="index.php?action=inscription"
        class="w-full bg-white border border-slate-100 rounded-[20px] shadow-card px-6 md:px-8 py-6 md:py-8">

        <!-- Ligne noms (2 colonnes) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="nom" class="block text-[13.5px] font-semibold text-slate-700 mb-1">
              <span class="mr-1">👤</span> Nom
            </label>
            <input id="nom" name="nom" type="text" placeholder="Votre nom"
              class="w-full h-11 rounded-[10px] border <?php echo (!empty($errors['nom'])) ? 'border-red-500 bg-red-50' : 'border-slate-200 bg-white'; ?> px-3.5 text-[14px] placeholder:text-slate-400 focus:border-emerald-600 focus:ring-0 shadow-input"
              value="<?php echo htmlspecialchars($_POST['nom'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" />
            <?php if (!empty($errors['nom'])): ?>
              <p class="text-red-600 text-[12px] mt-1">❌ <?php echo htmlspecialchars($errors['nom'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
          </div>
          <div>
            <label for="prenom" class="block text-[13.5px] font-semibold text-slate-700 mb-1">
              <span class="mr-1">👤</span> Prénom
            </label>
            <input id="prenom" name="prenom" type="text" placeholder="Votre prénom"
              class="w-full h-11 rounded-[10px] border <?php echo (!empty($errors['prenom'])) ? 'border-red-500 bg-red-50' : 'border-slate-200 bg-white'; ?> px-3.5 text-[14px] placeholder:text-slate-400 focus:border-emerald-600 focus:ring-0 shadow-input"
              value="<?php echo htmlspecialchars($_POST['prenom'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" />
            <?php if (!empty($errors['prenom'])): ?>
              <p class="text-red-600 text-[12px] mt-1">❌ <?php echo htmlspecialchars($errors['prenom'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
          </div>
        </div>

        <!-- Email -->
        <div class="mt-4">
          <label for="email" class="block text-[13.5px] font-semibold text-slate-700 mb-1">
            <span class="mr-1">📧</span> Adresse email
          </label>
          <input id="email" name="email" type="email" placeholder="votre.email@exemple.com"
            class="w-full h-11 rounded-[10px] border <?php echo (!empty($errors['email'])) ? 'border-red-500 bg-red-50' : 'border-slate-200 bg-white'; ?> px-3.5 text-[14px] placeholder:text-slate-400 focus:border-emerald-600 focus:ring-0 shadow-input"
            value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" />
          <?php if (!empty($errors['email'])): ?>
            <p class="text-red-600 text-[12px] mt-1">❌ <?php echo htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8'); ?></p>
          <?php endif; ?>
        </div>

        <!-- Password -->
        <div class="mt-4">
          <label for="password" class="block text-[13.5px] font-semibold text-slate-700 mb-1">
            <span class="mr-1">🔒</span> Mot de passe
          </label>
          <input id="password" name="password" type="password" placeholder="Au moins 8 caractères une majuscule et un chiffre"
            class="w-full h-11 rounded-[10px] border <?php echo (!empty($errors['password'])) ? 'border-red-500 bg-red-50' : 'border-slate-200 bg-white'; ?> px-3.5 text-[14px] placeholder:text-slate-400 focus:border-emerald-600 focus:ring-0 shadow-input" />
          <?php if (!empty($errors['password'])): ?>
            <p class="text-red-600 text-[12px] mt-1">❌ <?php echo htmlspecialchars($errors['password'], ENT_QUOTES, 'UTF-8'); ?></p>
          <?php endif; ?>
        </div>

        <!-- Confirm -->
        <div class="mt-4">
          <label for="password2" class="block text-[13.5px] font-semibold text-slate-700 mb-1">
            <span class="mr-1">🔒</span> Confirmer le mot de passe
          </label>
          <input id="password2" name="password2" type="password" placeholder="Répétez votre mot de passe"
            class="w-full h-11 rounded-[10px] border <?php echo (!empty($errors['password2'])) ? 'border-red-500 bg-red-50' : 'border-slate-200 bg-white'; ?> px-3.5 text-[14px] placeholder:text-slate-400 focus:border-emerald-600 focus:ring-0 shadow-input" />
          <?php if (!empty($errors['password2'])): ?>
            <p class="text-red-600 text-[12px] mt-1">❌ <?php echo htmlspecialchars($errors['password2'], ENT_QUOTES, 'UTF-8'); ?></p>
          <?php endif; ?>
        </div>

        <!-- Submit vert -->
        <button type="submit"
          style="background:linear-gradient(135deg,#18a04b 0%, #178a44 55%, #166c37 100%)"
          class="mt-5 w-full inline-flex items-center justify-center gap-2 h-11 rounded-[10px] font-semibold text-white
                       bg-gradient-to-r from-success-600 to-success-700 hover:from-success-700 hover:to-success-800 shadow-btn">
          ✨ Créer mon compte
        </button>

        <!-- Liens -->
        <p class="mt-4 text-center text-[14px] text-slate-600">
          Déjà un compte ?
          <a href="index.php?action=connexion" class="text-emerald-700 font-medium hover:underline">Se connecter</a>
        </p>
        <p class="mt-2 text-center text-[13px] text-slate-500">
          ← <a href="index.php?action=index" class="hover:underline">Retour à l'accueil</a>
        </p>
      </form>
    </div>
  </section>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>