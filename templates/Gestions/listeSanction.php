<?php
// listeSanction.php

$title = 'Gestion des Sanctions — Liste';
ob_start();

// --- CONFIGURATION ---
// 1. Définition des couleurs des badges selon l'ID du type de sanction
$typesColors = [
    1 => 'bg-amber-50 text-amber-700 border-amber-100',
    2 => 'bg-orange-50 text-orange-700 border-orange-100',
    3 => 'bg-rose-50 text-rose-700 border-rose-100',
    4 => 'bg-indigo-50 text-indigo-700 border-indigo-100',
];

$defaultColor = 'bg-slate-50 text-slate-700 border-slate-100';

?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['success_message'])): ?>
    <div class="mt-4 px-4">
        <div class="flex items-start gap-3 p-4 rounded-[12px] border border-green-300 bg-gradient-to-r from-green-50 to-green-100/60">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-green-600 text-white text-[18px]">✔</div>
            <div class="text-green-800 text-[14.6px] font-medium leading-snug"><?= htmlspecialchars($_SESSION['success_message']) ?></div>
        </div>
    </div>
<?php unset($_SESSION['success_message']);
endif; ?>

<div class="max-w-shell mx-auto px-4 py-10 space-y-8">

    <?php if (isset($error)): ?>
        <div class="bg-red-50 text-red-600 p-4 rounded-xl border border-red-200">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-2.5xl shadow-card">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-2xl">⚖️</span>
                <h1 class="text-2xl font-bold text-slate-800">Liste des Sanctions</h1>
            </div>
            <p class="text-slate-500 text-sm">Vue d'ensemble des incidents enregistrés</p>
        </div>
        <a href="index.php?action=creationSanction"
            class="inline-flex items-center justify-center rounded-xl bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-btn hover:bg-primary-700 transition-colors">
            <span class="mr-2 text-lg">+</span> Nouvelle Sanction
        </a>
    </div>

    <div class="rounded-2.5xl bg-white shadow-card overflow-hidden">

        <!-- Desktop: table visible à partir de sm -->
        <div class="hidden sm:block overflow-x-auto">
            <table class="min-w-full border-collapse text-sm text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="py-4 px-6 font-semibold text-slate-500 uppercase text-xs tracking-wider">Date</th>
                        <th class="py-4 px-6 font-semibold text-slate-500 uppercase text-xs tracking-wider">Type & Motif</th>
                        <th class="py-4 px-6 font-semibold text-slate-500 uppercase text-xs tracking-wider">Élève</th>
                        <th class="py-4 px-6 font-semibold text-slate-500 uppercase text-xs tracking-wider">Classe</th>
                        <th class="py-4 px-6 font-semibold text-slate-500 uppercase text-xs tracking-wider">Professeur</th>
                        <!-- Colonne Actions supprimée -->
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    <?php if (!empty($sanctions)): ?>
                        <?php foreach ($sanctions as $s): ?>
                            <?php
                            // --- PRÉPARATION DE L'AFFICHAGE ---

                            // Formatage Date
                            $date = date('d/m/Y', strtotime($s['date_sanction']));

                            // Choix couleur badge (fallback sur gris si type inconnu)
                            $badgeClass = $typesColors[$s['type_id']] ?? $defaultColor;

                            // Formatage Noms
                            $nomEleve = htmlspecialchars($s['eleve_prenom'] . ' ' . $s['eleve_nom']);
                            $nomProf = htmlspecialchars($s['prof_prenom'] . ' ' . $s['prof_nom']);
                            $initiales = mb_strtoupper(substr($s['eleve_prenom'], 0, 1) . substr($s['eleve_nom'], 0, 1));
                            ?>

                            <tr class="hover:bg-slate-50/80 transition-colors group">

                                <td class="py-4 px-6 font-medium text-slate-600 whitespace-nowrap">
                                    <?= $date ?>
                                </td>

                                <td class="py-4 px-6">
                                    <div class="flex flex-col items-start gap-1.5">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?= $badgeClass ?>">
                                            <?= htmlspecialchars($s['nom_type'] ?? 'Autre') ?>
                                        </span>
                                        <span class="text-slate-600 font-medium text-xs max-w-[250px] truncate" title="<?= htmlspecialchars($s['motif_sanction']) ?>">
                                            <?= htmlspecialchars($s['motif_sanction']) ?>
                                        </span>
                                    </div>
                                </td>

                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="h-9 w-9 shrink-0 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-xs font-bold ring-2 ring-white">
                                            <?= $initiales ?>
                                        </div>
                                        <span class="text-slate-900 font-semibold">
                                            <?= $nomEleve ?>
                                        </span>
                                    </div>
                                </td>

                                <td class="py-4 px-6">
                                    <?php if (!empty($s['nom_classe'])): ?>
                                        <span class="inline-flex items-center px-2 py-1 rounded-md bg-slate-100 text-slate-600 text-xs font-semibold border border-slate-200">
                                            <?= htmlspecialchars($s['nom_classe']) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-slate-400 text-xs italic">-</span>
                                    <?php endif; ?>
                                </td>

                                <td class="py-4 px-6 text-slate-500">
                                    <div class="flex items-center gap-2 text-sm">
                                        <span class="text-lg">👨‍🏫</span>
                                        <span><?= $nomProf ?></span>
                                    </div>
                                </td>

                                <!-- Actions supprimées pour l'affichage public -->
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <div class="mb-3 rounded-full bg-slate-50 p-4">
                                        <span class="text-2xl">👍</span>
                                    </div>
                                    <p class="text-sm font-medium text-slate-500">Aucune sanction trouvée.</p>
                                    <p class="text-xs mt-1">Tout semble calme pour le moment.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Mobile: cartes (visible sous sm) -->
        <div class="sm:hidden p-4 space-y-4">
            <?php if (!empty($sanctions)): ?>
                <?php foreach ($sanctions as $s): ?>
                    <?php
                    $date = date('d/m/Y', strtotime($s['date_sanction']));
                    $badgeClass = $typesColors[$s['type_id']] ?? $defaultColor;
                    $nomEleve = htmlspecialchars($s['eleve_prenom'] . ' ' . $s['eleve_nom']);
                    $nomProf = htmlspecialchars($s['prof_prenom'] . ' ' . $s['prof_nom']);
                    ?>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-100">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-xs text-slate-500"><?= $date ?></div>
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?= $badgeClass ?>">
                                        <?= htmlspecialchars($s['nom_type'] ?? 'Autre') ?>
                                    </span>
                                    <div class="text-sm text-slate-700 mt-2"><?= htmlspecialchars($s['motif_sanction']) ?></div>
                                </div>
                                <div class="mt-3 text-xs text-slate-500">Élève: <?= $nomEleve ?></div>
                                <div class="text-xs text-slate-500">Classe: <?= htmlspecialchars($s['nom_classe'] ?? '-') ?></div>
                                <div class="text-xs text-slate-500">Professeur: <?= $nomProf ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="py-12 text-center">
                    <div class="flex flex-col items-center justify-center text-slate-400">
                        <div class="mb-3 rounded-full bg-slate-50 p-4">
                            <span class="text-2xl">👍</span>
                        </div>
                        <p class="text-sm font-medium text-slate-500">Aucune sanction trouvée.</p>
                        <p class="text-xs mt-1">Tout semble calme pour le moment.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
// Inclusion du layout principal (adapte le chemin selon ton projet)
include __DIR__ . '/../layout.php';
?>