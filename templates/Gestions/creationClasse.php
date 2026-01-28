<?php

$title = 'Gestion des Sanctions — creation de classe';
ob_start();

?>


<div class="mx-auto max-w-4xl px-4 pb-16 pt-8 sm:pt-10 lg:pt-12">
    <!-- Hero / page title -->
    <section
        class="mb-8 rounded-3xl bg-gradient-to-r from-blue-600 via-blue-500 to-indigo-600 px-6 py-10 text-center text-white shadow-xl sm:px-10 sm:py-12">
        <div class="mx-auto max-w-xl">
            <div
                class="mx-auto mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-2xl">
                +
            </div>
            <h1 class="mb-2 text-2xl font-semibold sm:text-3xl">
                Créer une classe
            </h1>
            <p class="text-sm text-blue-100 sm:text-base">
                Ajoutez une nouvelle classe à votre établissement
            </p>
        </div>
    </section>

    <!-- Form card -->
    <section
        class="mb-6 rounded-2xl bg-white px-5 py-6 shadow-lg shadow-slate-200/80 sm:px-8 sm:py-7">
        <!-- Card header -->
        <div class="mb-6 border-b border-slate-100 pb-4">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-2">
                <div>
                    <h2 class="text-base font-semibold text-slate-900">
                        Informations de la classe
                    </h2>
                    <p class="mt-1 text-xs text-slate-500">
                        Renseignez les informations nécessaires pour créer la classe
                    </p>
                </div>
                <!-- AJOUT DU MESSAGE ICI -->
                <p class="text-xs text-slate-400 italic">
                    <span class="text-red-500">*</span> Champs obligatoires
                </p>
            </div>
        </div>

        <!-- Message d'erreur général éventuel -->
        <?php if (!empty($errors['general'])): ?>
            <div class="mb-4 rounded-lg bg-red-50 px-4 py-3 text-xs text-red-700 border border-red-200">
                <?= htmlspecialchars($errors['general']) ?>
            </div>
        <?php endif; ?>

        <!-- Form fields -->
        <form action="index.php?action=creationClasse" method="POST" class="space-y-5">
            <!-- Nom de la classe -->
            <div class="space-y-2">
                <label class="block text-xs font-medium text-slate-700" for="nom_classe">
                    Nom de la classe
                    <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="nom_classe"
                    name="nom_classe"
                    class="block w-full rounded-lg border <?= !empty($errors['nom_classe']) ? 'border-red-400' : 'border-slate-200' ?> bg-slate-50 px-3 py-2.5 text-sm text-slate-900 placeholder-slate-400 shadow-sm focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-blue-500"
                    placeholder="Ex: Terminale S1, Première ES2, Seconde A"
                    value="<?= htmlspecialchars($nom_classe ?? '') ?>" />
                <p class="text-xs text-slate-400">
                    Exemples : Terminale S1, Première ES2, Seconde A
                </p>
                <?php if (!empty($errors['nom_classe'])): ?>
                    <p class="text-xs text-red-500">
                        <?= htmlspecialchars($errors['nom_classe']) ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Niveau -->
            <div class="space-y-2">
                <label class="block text-xs font-medium text-slate-700" for="id_niveau">
                    Niveau
                    <span class="text-red-500">*</span>
                </label>
                <div
                    class="relative rounded-lg border <?= !empty($errors['id_niveau']) ? 'border-red-400' : 'border-slate-200' ?> bg-white shadow-sm focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500">
                    <select
                        id="id_niveau"
                        name="id_niveau"
                        class="block w-full appearance-none rounded-lg bg-transparent px-3 py-2.5 text-sm text-slate-900 focus:outline-none">
                        <option value="">Sélectionnez un niveau</option>
                        <?php if (!empty($niveaux) && is_array($niveaux)): ?>
                            <?php foreach ($niveaux as $niveau): ?>
                                <option
                                    value="<?= htmlspecialchars($niveau['id_niveau']) ?>"
                                    <?= (isset($id_niveau) && $id_niveau == $niveau['id_niveau']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($niveau['nom_niveau']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
                <?php if (!empty($errors['id_niveau'])): ?>
                    <p class="text-xs text-red-500">
                        <?= htmlspecialchars($errors['id_niveau']) ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Actions -->
            <div
                class="mt-6 flex flex-col gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                <a
                    href="index.php?action=listeClasse"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-100">
                    <span class="mr-2 text-base">←</span>
                    Retour à la liste
                </a>
                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    <span class="mr-1 text-base">+</span>
                    Créer la classe
                </button>
            </div>
        </form>
    </section>

    <!-- Info / conseil -->
    <section
        class="rounded-2xl border border-sky-100 bg-sky-50 px-5 py-4 text-sm text-sky-900 shadow-sm">
        <div class="flex items-start gap-3">
            <div
                class="mt-0.5 flex h-7 w-7 items-center justify-center rounded-full bg-sky-100 text-sky-500">
                i
            </div>
            <div class="space-y-0.5">
                <p class="font-medium text-sky-900">Conseil</p>
                <p class="text-xs text-sky-800">
                    Une fois la classe créée, vous pourrez y associer des élèves
                    et gérer leurs sanctions.
                </p>
            </div>
        </div>
    </section>
</div>


<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>