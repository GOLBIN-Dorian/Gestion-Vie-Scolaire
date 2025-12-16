<?php

$title = 'Gestion des Sanctions — Création de sanction';
ob_start();

?>

<div class="mx-auto max-w-6xl px-4 pb-16 pt-10 sm:px-6 lg:px-8">
    <section class="mb-10">
        <div class="rounded-2xl bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-8 text-center text-white shadow-card sm:px-12 sm:py-10">
            <div class="mb-3 flex justify-center">
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 01-2.031.352 5.989 5.989 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971z" />
                    </svg>
                </span>
            </div>
            <h1 class="mb-1 text-2xl font-semibold sm:text-3xl">
                Créer une sanction
            </h1>
            <p class="text-sm text-blue-100 sm:text-base">
                Enregistrez un nouvel incident disciplinaire
            </p>
        </div>
    </section>

    <section aria-labelledby="sanction-info-title" class="mb-8">
        <div class="mx-auto max-w-4xl rounded-2xl bg-white p-6 shadow-card sm:p-8">
            <header class="mb-6">
                <h2 id="sanction-info-title" class="text-base font-semibold text-slate-800 sm:text-lg">
                    Détails de l'incident
                </h2>
                <p class="mt-1 text-xs text-slate-500 sm:text-sm">
                    Tous les champs sont obligatoires pour assurer le suivi disciplinaire.
                </p>
            </header>

            <form class="space-y-6" method="post" action="index.php?action=creationSanction">

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="eleve" class="mb-1 block text-xs font-medium text-slate-700 sm:text-sm">
                            Élève concerné <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select
                                id="eleve"
                                name="id_eleve"
                                class="block w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 pr-9 text-sm text-slate-800 outline-none ring-0 transition focus:border-primary-500 focus:bg-white focus:ring-2 focus:ring-primary-100">
                                <option value="">Sélectionnez un élève</option>
                                <?php if (!empty($eleves) && is_array($eleves)): ?>
                                    <?php foreach ($eleves as $eleve): ?>
                                        <option
                                            value="<?= htmlspecialchars($eleve['id_eleve']) ?>"
                                            <?= (isset($id_eleve) && (string)$id_eleve === (string)$eleve['id_eleve']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($eleve['nom_eleve'] . ' ' . $eleve['prenom_eleve']) ?>
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
                        <?php if (!empty($errors['id_eleve'])): ?>
                            <p class="mt-1 text-xs text-red-500">
                                <?= htmlspecialchars($errors['id_eleve']) ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="professeur" class="mb-1 block text-xs font-medium text-slate-700 sm:text-sm">
                            Professeur référent <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select
                                id="professeur"
                                name="id_prof"
                                class="block w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 pr-9 text-sm text-slate-800 outline-none ring-0 transition focus:border-primary-500 focus:bg-white focus:ring-2 focus:ring-primary-100">
                                <option value="">Sélectionnez un professeur</option>
                                <?php if (!empty($professeurs) && is_array($professeurs)): ?>
                                    <?php foreach ($professeurs as $prof): ?>
                                        <option
                                            value="<?= htmlspecialchars($prof['id_prof']) ?>"
                                            <?= (isset($id_prof) && (string)$id_prof === (string)$prof['id_prof']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($prof['nom_prof'] . ' ' . $prof['prenom_prof']) ?>
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
                        <?php if (!empty($errors['id_prof'])): ?>
                            <p class="mt-1 text-xs text-red-500">
                                <?= htmlspecialchars($errors['id_prof']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="type_sanction" class="mb-1 block text-xs font-medium text-slate-700 sm:text-sm">
                            Type de sanction <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select
                                id="type_sanction"
                                name="type_sanction"
                                class="block w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 pr-9 text-sm text-slate-800 outline-none ring-0 transition focus:border-primary-500 focus:bg-white focus:ring-2 focus:ring-primary-100">
                                <option value="">Choisir un type</option>
                                <?php
                                $types = $types ?? ['Avertissement', 'Retenue', 'Exclusion temporaire', 'Exclusion définitive', 'Travail d\'intérêt général'];
                                foreach ($types as $type):
                                ?>
                                    <option
                                        value="<?= htmlspecialchars($type) ?>"
                                        <?= (isset($type_sanction) && $type_sanction === $type) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($type) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <?php if (!empty($errors['type_sanction'])): ?>
                            <p class="mt-1 text-xs text-red-500">
                                <?= htmlspecialchars($errors['type_sanction']) ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="date_incident" class="mb-1 block text-xs font-medium text-slate-700 sm:text-sm">
                            Date de l'incident <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input
                                id="date_incident"
                                name="date_incident"
                                type="date"
                                value="<?= htmlspecialchars($date_incident ?? '') ?>"
                                class="block w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-800 outline-none ring-0 transition focus:border-primary-500 focus:bg-white focus:ring-2 focus:ring-primary-100" />
                        </div>
                        <p class="mt-1 text-[11px] text-slate-400 sm:text-xs">
                            Date à laquelle l'incident a eu lieu.
                        </p>
                        <?php if (!empty($errors['date_incident'])): ?>
                            <p class="mt-1 text-xs text-red-500">
                                <?= htmlspecialchars($errors['date_incident']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <label for="motif" class="mb-1 block text-xs font-medium text-slate-700 sm:text-sm">
                        Motif de la sanction <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        id="motif"
                        name="motif"
                        rows="4"
                        placeholder="Décrivez l'incident en détail (minimum 10 caractères)..."
                        class="block w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-800 outline-none ring-0 transition focus:border-primary-500 focus:bg-white focus:ring-2 focus:ring-primary-100"><?= htmlspecialchars($motif ?? '') ?></textarea>
                    <?php if (!empty($errors['motif'])): ?>
                        <p class="mt-1 text-xs text-red-500">
                            <?= htmlspecialchars($errors['motif']) ?>
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
                        href="index.php?action=listeSanctions"
                        class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        Annuler
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-primary-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Créer la sanction
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section aria-label="Information sanction" class="mx-auto max-w-4xl">
        <div class="flex items-start rounded-2xl border border-blue-100 bg-blue-50 px-4 py-4 shadow-sm sm:px-5 sm:py-5">
            <div class="mr-3 mt-0.5 flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-full bg-blue-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-800">
                    Important
                </p>
                <p class="mt-1 text-xs text-slate-600 sm:text-sm">
                    Une fois créée, la sanction sera visible dans l'historique de l'élève et accessible depuis la liste des sanctions pour le suivi. Assurez-vous d'avoir sélectionné le bon professeur référent.
                </p>
            </div>
        </div>
    </section>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>