<?php

$title = 'Gestion des Sanctions — creation d\'élève';
ob_start();

?>

<div class="mx-auto max-w-6xl px-4 pb-16 pt-10 sm:px-6 lg:px-8">
    <!-- Hero banner -->
    <section class="mb-10">
        <div class="rounded-2xl bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-8 text-center text-white shadow-card sm:px-12 sm:py-10">
            <div class="mb-3 flex justify-center">
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5A7.5 7.5 0 0112 15a7.5 7.5 0 017.5 4.5" />
                    </svg>
                </span>
            </div>
            <h1 class="mb-1 text-2xl font-semibold sm:text-3xl">
                Créer un élève
            </h1>
            <p class="text-sm text-blue-100 sm:text-base">
                Ajoutez un nouvel élève à votre établissement
            </p>
        </div>
    </section>

    <!-- Form card -->
    <section aria-labelledby="student-info-title" class="mb-8">
        <div class="mx-auto max-w-4xl rounded-2xl bg-white p-6 shadow-card sm:p-8">
            <header class="mb-6">
                <!-- Ajout du conteneur flex pour aligner le titre et le message d'obligation -->
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-2">
                    <div>
                        <h2 id="student-info-title" class="text-base font-semibold text-slate-800 sm:text-lg">
                            Informations de l'élève
                        </h2>
                        <p class="mt-1 text-xs text-slate-500 sm:text-sm">
                            Renseignez les informations nécessaires pour créer l'élève
                        </p>
                    </div>
                    <!-- AJOUT DU MESSAGE ICI -->
                    <p class="text-xs text-slate-400 italic">
                        <span class="text-red-500">*</span> Champs obligatoires
                    </p>
                </div>
            </header>

            <!-- On ajoute method="post" -->
            <form class="space-y-6" method="post" action="index.php?action=creationEleve">
                <!-- Nom / Prénom -->
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="nom" class="mb-1 block text-xs font-medium text-slate-700 sm:text-sm">
                            Nom <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="nom"
                            name="nom_eleve"
                            type="text"
                            placeholder="Ex: Martin"
                            value="<?= htmlspecialchars($nom_eleve ?? '') ?>"
                            class="block w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-800 outline-none ring-0 transition focus:border-primary-500 focus:bg-white focus:ring-2 focus:ring-primary-100" />
                        <?php if (!empty($errors['nom_eleve'])): ?>
                            <p class="mt-1 text-xs text-red-500">
                                <?= htmlspecialchars($errors['nom_eleve']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="prenom" class="mb-1 block text-xs font-medium text-slate-700 sm:text-sm">
                            Prénom <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="prenom"
                            name="prenom_eleve"
                            type="text"
                            placeholder="Ex: Jean"
                            value="<?= htmlspecialchars($prenom_eleve ?? '') ?>"
                            class="block w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-800 outline-none ring-0 transition focus:border-primary-500 focus:bg-white focus:ring-2 focus:ring-primary-100" />
                        <?php if (!empty($errors['prenom_eleve'])): ?>
                            <p class="mt-1 text-xs text-red-500">
                                <?= htmlspecialchars($errors['prenom_eleve']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Date de naissance (on garde ton format visuel) -->
                <div>
                    <label for="date-naissance" class="mb-1 block text-xs font-medium text-slate-700 sm:text-sm">
                        Date de naissance <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input
                            id="date-naissance"
                            name="date_naissance"
                            type="text"
                            placeholder="jj/mm/aaaa"
                            value="<?= htmlspecialchars($date_naissance ?? '') ?>"
                            class="block w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 pr-10 text-sm text-slate-800 outline-none ring-0 transition focus:border-primary-500 focus:bg-white focus:ring-2 focus:ring-primary-100" />
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <path d="M16 2v4M8 2v4M3 10h18"></path>
                            </svg>
                        </span>
                    </div>
                    <p class="mt-1 text-[11px] text-slate-400 sm:text-xs">
                        Format : JJ/MM/AAAA
                    </p>
                    <?php if (!empty($errors['date_naissance'])): ?>
                        <p class="mt-1 text-xs text-red-500">
                            <?= htmlspecialchars($errors['date_naissance']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Classe (depuis la BDD) -->
                <div>
                    <label for="classe" class="mb-1 block text-xs font-medium text-slate-700 sm:text-sm">
                        Classe <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select
                            id="classe"
                            name="id_classe"
                            class="block w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 pr-9 text-sm text-slate-800 outline-none ring-0 transition focus:border-primary-500 focus:bg-white focus:ring-2 focus:ring-primary-100">
                            <option value="">Sélectionnez une classe</option>

                            <?php if (!empty($classes) && is_array($classes)): ?>
                                <?php foreach ($classes as $classe): ?>
                                    <?php
                                    $classeId  = $classe['id_classe'] ?? null;
                                    $classeNom = $classe['nom_classe'] ?? ($classe['libelle_classe'] ?? ('Classe ' . $classeId));
                                    ?>
                                    <option
                                        value="<?= htmlspecialchars($classeId) ?>"
                                        <?= (isset($id_classe) && (string)$id_classe === (string)$classeId) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($classeNom) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                    <?php if (!empty($errors['id_classe'])): ?>
                        <p class="mt-1 text-xs text-red-500">
                            <?= htmlspecialchars($errors['id_classe']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Erreur générale -->
                <?php if (!empty($errors['general'])): ?>
                    <div class="rounded-lg bg-red-50 px-3 py-2 text-xs text-red-600 sm:text-sm">
                        <?= htmlspecialchars($errors['general']) ?>
                    </div>
                <?php endif; ?>

                <!-- Actions -->
                <div class="flex flex-col gap-3 pt-2 sm:flex-row sm:justify-between">
                    <a
                        href="index.php?action=listeEleves"
                        class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        Retour à la liste
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-primary-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Créer l'élève
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section aria-label="Conseil création élève" class="mx-auto max-w-4xl">
        <div class="flex items-start rounded-2xl border border-blue-100 bg-blue-50 px-4 py-4 shadow-sm sm:px-5 sm:py-5">
            <div class="mr-3 mt-0.5 flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-full bg-blue-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m0 4.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                    <circle cx="12" cy="12" r="9" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-800">
                    Conseil
                </p>
                <p class="mt-1 text-xs text-slate-600 sm:text-sm">
                    Une fois l'élève créé, vous pourrez lui associer des sanctions et suivre son parcours dans l'établissement.
                </p>
            </div>
        </div>
    </section>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>