<?php

$title = 'Gestion des Sanctions — liste des classes';
ob_start();

?>

<div class="max-w-shell mx-auto px-4 py-10 space-y-8">

    <!-- Message de succès -->
    <?php if (!empty($_SESSION['success_message'])): ?>
        <div class="flex items-center gap-2 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl px-4 py-3 text-sm">
            <span class="font-semibold">Succès :</span>
            <?= htmlspecialchars($_SESSION['success_message']); ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>


    <!-- Bloc hero Gestion des classes -->
    <section class="rounded-2.5xl bg-primary-600 shadow-card px-6 py-10 md:px-10 text-center text-white">
        <div class="flex flex-col items-center gap-3">
            <div class="text-4xl">📚</div>
            <h1 class="text-2xl md:text-3xl font-semibold">
                Gestion des classes
            </h1>
            <p class="text-sm md:text-base text-primary-100">
                Gérez les classes de votre établissement
            </p>
            <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
                <a href="index.php?action=creationClasse"
                    class="inline-flex items-center justify-center rounded-xl bg-white px-4 py-2 text-sm font-medium text-primary-700 shadow-btn hover:bg-blue-50">
                    <span class="mr-2 flex h-5 w-5 items-center justify-center rounded-full bg-primary-600 text-xs text-white">+</span>
                    Créer une classe
                </a>
                <a href="index.php?action=dashboard"
                    class="inline-flex items-center justify-center rounded-xl bg-primary-500 px-4 py-2 text-sm font-medium text-white shadow-btn hover:bg-primary-700">
                    Tableau de bord
                </a>
            </div>
        </div>
    </section>

    <!-- Bloc liste des classes -->
    <section class="rounded-2.5xl bg-white px-4 py-4 md:px-6 md:py-6 shadow-card">

        <!-- En-tête -->
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                Liste des classes
            </h2>
            <a href="index.php?action=creationClasse"
                class="inline-flex items-center justify-center rounded-xl bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-btn hover:bg-primary-700">
                <span class="mr-2 flex h-5 w-5 items-center justify-center rounded-full bg-white/10 text-xs">+</span>
                Nouvelle classe
            </a>
        </div>

        <!-- Tableau -->
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse text-sm">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-semibold uppercase tracking-wide text-slate-400">
                        <th class="py-2 pr-4 text-left">Nom de la classe</th>
                        <th class="py-2 px-4 text-left">Niveau</th>
                        <th class="py-2 pl-4 text-left">Créée le</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($classes) && is_array($classes)): ?>
                        <?php foreach ($classes as $classe): ?>
                            <?php
                            $nom_niveau = $classe['nom_niveau'] ?? '';
                            $badgeBase = 'inline-flex items-center rounded-full border px-3 py-1 text-xs font-medium';
                            $badgeClasses = $badgeBase . ' border-slate-200 bg-slate-50 text-slate-700';

                            if ($nom_niveau === 'BTS') {
                                $badgeClasses = $badgeBase . ' border-amber-100 bg-amber-50 text-amber-700';
                            } elseif ($nom_niveau === 'Première') {
                                $badgeClasses = $badgeBase . ' border-emerald-100 bg-emerald-50 text-emerald-700';
                            } elseif ($nom_niveau === 'Seconde') {
                                $badgeClasses = $badgeBase . ' border-sky-100 bg-sky-50 text-sky-700';
                            } elseif ($nom_niveau === 'Terminale') {
                                $badgeClasses = $badgeBase . ' border-fuchsia-100 bg-fuchsia-50 text-fuchsia-700';
                            }
                            ?>
                            <tr class="border-b border-slate-100 last:border-0 hover:bg-slate-50/70">

                                <!-- Nom de la classe -->
                                <td class="py-3 pr-4">
                                    <div class="flex items-center gap-3">
                                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-blue-200 text-xs font-semibold text-slate-700">
                                            <?= mb_strtoupper(substr($classe['nom_niveau'], 0, 2), 'UTF-8') ?>
                                        </span>
                                        <span class="text-sm font-medium text-slate-900">
                                            <?= htmlspecialchars($classe['nom_classe'] ?? '') ?>
                                        </span>
                                    </div>
                                </td>

                                <!-- Niveau -->
                                <td class="py-3 px-4">
                                    <span class="<?= $badgeClasses ?>">
                                        <?= htmlspecialchars($nom_niveau) ?>
                                    </span>
                                </td>

                                <!-- Date -->
                                <td class="py-3 pl-4">
                                    <div class="flex items-center gap-2 text-slate-500">
                                        <span class="inline-flex h-4 w-4 items-center justify-center text-[10px]">📅</span>
                                        <span class="text-sm">
                                            <?= htmlspecialchars($classe['date_creation'] ?? '') ?>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="py-6 text-center text-sm text-slate-500">
                                Aucune classe trouvée pour le moment.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>