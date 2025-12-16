<?php

$title = 'Gestion des Sanctions — Création de professeur';
ob_start();

?>

<div class="mx-auto max-w-6xl px-4 pb-16 pt-10 sm:px-6 lg:px-8">
    <section class="mb-10">
        <div class="rounded-2xl bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-8 text-center text-white shadow-card sm:px-12 sm:py-10">
            <div class="mb-3 flex justify-center">
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                    </svg>
                </span>
            </div>
            <h1 class="mb-1 text-2xl font-semibold sm:text-3xl">
                Créer un professeur
            </h1>
            <p class="text-sm text-blue-100 sm:text-base">
                Ajoutez un nouveau membre à l'équipe pédagogique
            </p>
        </div>
    </section>

    <section aria-labelledby="prof-info-title" class="mb-8">
        <div class="mx-auto max-w-4xl rounded-2xl bg-white p-6 shadow-card sm:p-8">
            <header class="mb-6">
                <h2 id="prof-info-title" class="text-base font-semibold text-slate-800 sm:text-lg">
                    Informations du professeur
                </h2>
                <div class="mt-1 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-xs text-slate-500 sm:text-sm">
                        Renseignez les informations ci-dessous.
                    </p>
                    <p class="mt-2 text-xs text-slate-400 sm:mt-0">
                        Les champs marqués d'un <span class="font-bold text-red-500">*</span> sont obligatoires.
                    </p>
                </div>
            </header>

            <form class="space-y-6" method="post" action="index.php?action=creationProf">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="nom" class="mb-1 block text-xs font-medium text-slate-700 sm:text-sm">
                            Nom <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="nom"
                            name="nom_prof"
                            type="text"
                            placeholder="Ex: Dupont"
                            value="<?= htmlspecialchars($nom_prof ?? '') ?>"
                            class="block w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-800 outline-none ring-0 transition focus:border-primary-500 focus:bg-white focus:ring-2 focus:ring-primary-100" />
                        <?php if (!empty($errors['nom_prof'])): ?>
                            <p class="mt-1 text-xs text-red-500">
                                <?= htmlspecialchars($errors['nom_prof']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="prenom" class="mb-1 block text-xs font-medium text-slate-700 sm:text-sm">
                            Prénom <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="prenom"
                            name="prenom_prof"
                            type="text"
                            placeholder="Ex: Marie"
                            value="<?= htmlspecialchars($prenom_prof ?? '') ?>"
                            class="block w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-800 outline-none ring-0 transition focus:border-primary-500 focus:bg-white focus:ring-2 focus:ring-primary-100" />
                        <?php if (!empty($errors['prenom_prof'])): ?>
                            <p class="mt-1 text-xs text-red-500">
                                <?= htmlspecialchars($errors['prenom_prof']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <label for="matiere" class="mb-1 block text-xs font-medium text-slate-700 sm:text-sm">
                        Matière <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input
                            id="matiere"
                            name="matiere"
                            type="text"
                            placeholder="Ex: Mathématiques, Histoire-Géographie, EPS..."
                            value="<?= htmlspecialchars($matiere ?? '') ?>"
                            class="block w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 pr-10 text-sm text-slate-800 outline-none ring-0 transition focus:border-primary-500 focus:bg-white focus:ring-2 focus:ring-primary-100" />
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                        </span>
                    </div>
                    <p class="mt-1 text-[11px] text-slate-400 sm:text-xs">
                        Indiquez la discipline principale enseignée par le professeur.
                    </p>
                    <?php if (!empty($errors['matiere'])): ?>
                        <p class="mt-1 text-xs text-red-500">
                            <?= htmlspecialchars($errors['matiere']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <?php if (!empty($errors['general'])): ?>
                    <div class="rounded-lg bg-red-50 px-3 py-2 text-xs text-red-600 sm:text-sm">
                        <?= htmlspecialchars($errors['general']) ?>
                    </div>
                <?php endif; ?>

                <div class="flex flex-col gap-3 pt-2 sm:flex-row sm:justify-between">
                    <a
                        href="index.php?action=listeProfesseurs"
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
                        Créer le professeur
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section aria-label="Conseil création professeur" class="mx-auto max-w-4xl">
        <div class="flex items-start rounded-2xl border border-blue-100 bg-blue-50 px-4 py-4 shadow-sm sm:px-5 sm:py-5">
            <div class="mr-3 mt-0.5 flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-full bg-blue-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m0 4.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                    <circle cx="12" cy="12" r="9" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-800">
                    Pourquoi créer un professeur ?
                </p>
                <p class="mt-1 text-xs text-slate-600 sm:text-sm">
                    La création de professeurs est un prérequis pour pouvoir les associer aux sanctions (en tant que demandeur ou référent) lors de l'enregistrement d'un incident.
                </p>
            </div>
        </div>
    </section>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>