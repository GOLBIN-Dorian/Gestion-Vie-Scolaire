<?php
// Tu peux laisser le title ici ou le passer uniquement via le controller
$title = 'Gestion des Sanctions — Liste des élèves';
ob_start();
?>
<div class="mx-auto max-w-6xl px-4 pb-16 pt-10 sm:px-6 lg:px-8">
    <section class="mb-10">
        <div class="rounded-2xl bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-8 text-center text-white shadow-card sm:px-12 sm:py-10">
            <div class="mb-3 flex justify-center">
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7a3 3 0 116 0 3 3 0 01-6 0zM4 21a4 4 0 018 0M14.5 8.5a2.5 2.5 0 115 0 2.5 2.5 0 01-5 0zM16.5 14h.75a3.75 3.75 0 013.75 3.75V19" />
                    </svg>
                </span>
            </div>
            <h1 class="mb-1 text-2xl font-semibold sm:text-3xl">
                Gestion des élèves
            </h1>
            <p class="mb-6 text-sm text-blue-100 sm:text-base">
                Gérez les élèves de votre établissement
            </p>

            <div class="flex flex-col justify-center gap-3 sm:flex-row sm:space-x-3">
                <a
                    href="index.php?action=creationEleve"
                    class="inline-flex items-center justify-center rounded-lg bg-white px-5 py-2.5 text-sm font-semibold text-primary-600 shadow-sm transition hover:bg-blue-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Créer un élève
                </a>
                <a
                    href="index.php?action=dashboard"
                    class="inline-flex items-center justify-center rounded-lg bg-primary-500 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2 4 4 10-10 2 2L9 18 3 12z" />
                    </svg>
                    Tableau de bord
                </a>
            </div>
        </div>
    </section>

    <!-- Liste dynamique -->
    <section aria-labelledby="liste-eleves-titre">
        <div class="mx-auto max-w-5xl rounded-2xl bg-white shadow-card">
            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 sm:px-6">
                <h2 id="liste-eleves-titre" class="text-sm font-semibold text-slate-800 sm:text-base">
                    Liste des élèves
                </h2>
                <a
                    href="index.php?action=creationEleve"
                    class="inline-flex items-center rounded-lg bg-primary-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-primary-700 sm:text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Nouvel élève
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm text-slate-700">
                    <thead class="border-b border-slate-100 bg-slate-50 text-xs font-medium uppercase text-slate-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nom de l'élève</th>
                            <th scope="col" class="px-6 py-3">Classe</th>
                            <th scope="col" class="px-6 py-3">Niveau</th>
                            <th scope="col" class="px-6 py-3">Né le</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if (!empty($eleves)) : ?>
                            <?php foreach ($eleves as $eleve) : ?>
                                <?php
                                $prenomBrut = isset($eleve['prenom_eleve']) ? trim($eleve['prenom_eleve']) : '';
                                $nomBrut    = isset($eleve['nom_eleve']) ? trim($eleve['nom_eleve']) : '';
                                $classe     = isset($eleve['classe']) ? trim($eleve['classe']) : '';
                                $niveauVal  = isset($eleve['niveau']) ? trim($eleve['niveau']) : '';
                                $dateSql    = isset($eleve['date_naissance']) ? $eleve['date_naissance'] : null;
                                $i1 = $prenomBrut !== '' ? mb_substr($prenomBrut, 0, 1) : '';
                                $i2 = $nomBrut !== '' ? mb_substr($nomBrut, 0, 1) : '';
                                $initiales = mb_strtoupper($i1 . $i2);
                                $prenomAffiche = $prenomBrut !== ''
                                    ? mb_convert_case($prenomBrut, MB_CASE_TITLE, 'UTF-8')
                                    : '';
                                $nomAffiche = $nomBrut !== ''
                                    ? mb_strtoupper($nomBrut, 'UTF-8')
                                    : '';
                                $nomComplet = trim($prenomAffiche . ' ' . $nomAffiche);
                                $badgeClasses = 'bg-slate-100 text-slate-400';
                                $niveauAffiche = '—';

                                if ($niveauVal !== '') {
                                    $niveauLower = mb_strtolower($niveauVal, 'UTF-8');
                                    $niveauAffiche = $niveauVal;

                                    if ($niveauLower === 'première') {
                                        $badgeClasses = 'bg-emerald-50 text-emerald-500';
                                    } elseif ($niveauLower === 'seconde') {
                                        $badgeClasses = 'bg-sky-50 text-sky-500';
                                    } elseif ($niveauLower === 'terminale') {
                                        $badgeClasses = 'bg-fuchsia-50 text-fuchsia-500';
                                    }
                                }

                                $dateAffiche = '-';
                                if (!empty($dateSql)) {
                                    try {
                                        $d = new DateTime($dateSql);
                                        $dateAffiche = $d->format('d/m/Y');
                                    } catch (Exception $e) {
                                        $dateAffiche = $dateSql;
                                    }
                                }
                                ?>
                                <tr class="hover:bg-slate-50/80">
                                    <td class="whitespace-nowrap px-6 py-3">
                                        <div class="flex items-center space-x-3">
                                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-[11px] font-semibold text-primary-700">
                                                <?= htmlspecialchars($initiales, ENT_QUOTES, 'UTF-8') ?>
                                            </span>
                                            <span class="text-sm font-medium text-slate-800">
                                                <?= htmlspecialchars($nomComplet, ENT_QUOTES, 'UTF-8') ?>
                                            </span>
                                        </div>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-3 text-sm text-slate-600">
                                        <?= $classe !== ''
                                            ? htmlspecialchars($classe, ENT_QUOTES, 'UTF-8')
                                            : '—' ?>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-3">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold <?= $badgeClasses ?>">
                                            <?= htmlspecialchars($niveauAffiche, ENT_QUOTES, 'UTF-8') ?>
                                        </span>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-3 text-sm text-slate-500">
                                        <span class="inline-flex items-center space-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                <path d="M16 2v4M8 2v4M3 10h18"></path>
                                            </svg>
                                            <span><?= htmlspecialchars($dateAffiche, ENT_QUOTES, 'UTF-8') ?></span>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-sm text-slate-500">
                                    Aucun élève n'a encore été enregistré dans l'établissement.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>