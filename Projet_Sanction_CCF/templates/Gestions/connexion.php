<?php
$title = 'Gestion des Sanctions — Connexion';
ob_start();

if (!isset($errors) || !is_array($errors)) {
  $errors = [];
}
if (!isset($email)) {
  $email = '';
}
if (!isset($success)) {
  $success = null;
}
?>

<div class="mx-auto max-w-shell px-5">

  <!-- HERO -->
  <section class="mt-8 md:mt-10">
    <div
      class="mx-auto max-w-[1040px] rounded-[18px] md:rounded-[20px] text-white px-8 md:px-12 py-10 md:py-12 shadow-card"
      style="background: linear-gradient(135deg,#2f66f0 0%, #264fcd 55%, #1b3ea6 100%);">
      <h1 class="flex items-center justify-center gap-3 text-[30px] md:text-[36px] font-extrabold tracking-tight">
        <span class="text-[30px] md:text-[36px]">🔐</span> Connexion
      </h1>
      <p class="mt-2 text-center text-indigo-100/95 text-[15px] md:text-[16px]">
        Accédez à votre espace personnel
      </p>
    </div>
  </section>

  <section class="grid place-items-center mt-10">

    <?php if (!empty($success)): ?>
      <div class="mb-6 w-full max-w-[560px]">
        <div class="flex items-start gap-3 p-4 rounded-[16px] border border-green-300 shadow-card bg-gradient-to-r from-green-50 to-green-100/60">
          <div class="flex h-9 w-9 items-center justify-center rounded-full bg-green-600 text-white text-[18px]">
            ✔
          </div>
          <div class="text-green-800 text-[14.6px] font-medium leading-snug">
            <?= htmlspecialchars($success) ?>
          </div>
        </div>
      </div>
    <?php endif; ?>


    <!-- Message d'erreur de login -->
    <?php if (!empty($errors['login'] ?? null)): ?>
      <div class="mb-6 w-full max-w-[560px]">
        <div class="p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-[10px] text-[14px] leading-snug">
          <p><?php echo $errors['login']; ?></p>
        </div>
      </div>
    <?php endif; ?>

    <form
      <?php echo isset($_GET['redirect']) ? 'action="?redirect=' . htmlspecialchars($_GET['redirect']) . '"' : ''; ?>
      class="w-full max-w-[560px] bg-white border border-slate-100 rounded-[20px] shadow-card px-6 md:px-8 py-6 md:py-7"
      method="POST">

      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="block text-[13.5px] font-semibold text-slate-700 mb-1">
          <span class="mr-1">📧</span> Adresse email
        </label>
        <input
          id="email"
          type="email"
          placeholder="votre.email@exemple.com"
          name="email"
          value="<?php echo htmlspecialchars($email); ?>"
          class="w-full h-11 rounded-[10px] border border-slate-200 bg-white px-3.5 text-[14px] placeholder:text-slate-400 focus:border-primary-600 focus:ring-0 shadow-input" />
        <span class="text-sm text-red-600"><?php echo $errors['email'] ?? ''; ?></span>
      </div>

      <!-- Password -->
      <div class="mb-1.5">
        <label for="password" class="block text-[13.5px] font-semibold text-slate-700 mb-1">
          <span class="mr-1">🔒</span> Mot de passe
        </label>
        <input
          id="password"
          type="password"
          placeholder="Votre mot de passe"
          name="password"
          class="w-full h-11 rounded-[10px] border border-slate-200 bg-white px-3.5 text-[14px] placeholder:text-slate-400 focus:border-primary-600 focus:ring-0 shadow-input" />
        <span class="text-sm text-red-600"><?php echo $errors['password'] ?? ''; ?></span>
      </div>

      <!-- Submit -->
      <button
        type="submit"
        class="mt-4 w-full inline-flex items-center justify-center gap-2 h-11 rounded-[10px] font-semibold text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 shadow-btn">
        <span>🛠️</span> Se connecter
      </button>

      <!-- Links -->
      <p class="mt-4 text-center text-[14px] text-slate-600">
        Pas encore de compte ?
        <a href="index.php?action=inscription" class="text-primary-700 font-medium hover:underline">Créer un compte</a>
      </p>
      <p class="mt-2 text-center text-[13px] text-slate-500">
        ← <a href="index.php?action=index" class="hover:underline">Retour à l’accueil</a>
      </p>
    </form>
  </section>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>