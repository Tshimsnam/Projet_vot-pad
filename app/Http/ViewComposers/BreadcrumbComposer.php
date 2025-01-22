<?php
namespace App\Http\ViewComposers;

use App\Exceptions\BreadcrumbException;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class BreadcrumbComposer
{
    public function compose(View $view)
    {
        $breadcrumbs = [];
        $evenement   = session('breadEvenement');
        $phase       = session('breadPhase');

        try {
            switch (Route::currentRouteName()) {
                case 'dashboard':
                    $breadcrumbs = [
                        ['title' => 'Dashboard', 'url' => route('dashboard')],
                    ];
                    break;

                case 'evenements.index':
                    $breadcrumbs = [
                        ['title' => 'Evénements', 'url' => route('evenements.index')],
                    ];
                    break;

                case 'evenements.show':
                    $evenement = Route::current()->parameter('evenement');
                    if (! $evenement) {
                        throw new BreadcrumbException('Erreur de breadcrumbs');
                    }
                    $breadcrumbs = [
                        ['title' => 'Evénements', 'url' => route('evenements.index')],
                        ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])],
                    ];
                    break;

                case 'phase.show':
                    $phase = Route::current()->parameter('id');
                    if (! $evenement) {
                        throw new BreadcrumbException('Erreur de breadcrumbs');
                    }
                    $breadcrumbs = [
                        ['title' => 'Evénements', 'url' => route('evenements.index')],
                        ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])],
                        ['title' => 'Détail Phase', 'url' => route('phase.show', ['id' => $phase])],
                    ];
                    break;

                case 'evenements.create':
                    $breadcrumbs = [
                        ['title' => 'Evénements', 'url' => route('evenements.index')],
                        ['title' => 'Configuration', 'url' => route('evenements.create')],
                    ];
                    break;

                case 'evenements.edit':
                    if (! $evenement) {
                        throw new BreadcrumbException('Erreur de breadcrumbs');
                    }
                    $breadcrumbs = [
                        ['title' => 'Evénements', 'url' => route('evenements.index')],
                        ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])],
                        ['title' => 'Modifier Evénement', 'url' => route('evenements.edit', ['evenement' => $evenement])],
                    ];
                    break;

                case 'phase.create':
                    if (! $evenement) {
                        throw new BreadcrumbException('Erreur de breadcrumbs');
                    }
                    $breadcrumbs = [
                        ['title' => 'Evénements', 'url' => route('evenements.index')],
                        ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])],
                        ['title' => 'Créer Phase', 'url' => route('phase.create', ['evenement_id' => $evenement])],
                    ];
                    break;

                case 'resultats.show':
                    $resultat = Route::current()->parameter('resultat');
                    if (! $evenement || ! $phase) {
                        throw new BreadcrumbException('Erreur de breadcrumbs');
                    }
                    $breadcrumbs = [
                        ['title' => 'Evénements', 'url' => route('evenements.index')],
                        ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])],
                        ['title' => 'Détail Phase', 'url' => route('phase.show', ['id' => $phase])],
                        ['title' => 'Résultat', 'url' => route('resultats.show', ['resultat' => $resultat])],
                    ];
                    break;

                case 'results':
                    $resultat = Route::current()->parameter('phase');
                    if (! $evenement || ! $phase) {
                        throw new BreadcrumbException('Erreur de breadcrumbs');
                    }
                    $breadcrumbs = [
                        ['title' => 'Evénements', 'url' => route('evenements.index')],
                        ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])],
                        ['title' => 'Détail Phase', 'url' => route('phase.show', ['id' => $phase])],
                        ['title' => 'Résultat', 'url' => route('resultats.show', ['resultat' => $resultat])],
                    ];
                    break;

                case 'restultatDetatil':
                    $intervId = Route::current()->parameter('interv_id');
                    if (! $evenement || ! $phase) {
                        throw new BreadcrumbException('Erreur de breadcrumbs');
                    }
                    $breadcrumbs[] = ['title' => 'Evénements', 'url' => route('evenements.index')];
                    $breadcrumbs[] = ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])];
                    $breadcrumbs[] = ['title' => 'Détail Phase', 'url' => route('phase.show', ['id' => $phase])];
                    $breadcrumbs[] = ['title' => 'Résultat', 'url' => route('resultats.show', ['resultat' => $phase])];
                    $breadcrumbs[] = [
                        'title' => 'Résultats Détail',
                        'url'   => route('restultatDetatil', ['phase_id' => $phase, 'interv_id' => $intervId]),
                    ];
                    break;

                case 'mail.view':
                    if (! $evenement || ! $phase) {
                        throw new BreadcrumbException('Erreur de breadcrumbs');
                    }
                    $breadcrumbs = [
                        ['title' => 'Evénements', 'url' => route('evenements.index')],
                        ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])],
                        ['title' => 'Détail Phase', 'url' => route('phase.show', ['id' => $phase])],
                        ['title' => 'Gestion des mails', 'url' => route('mail.view', ['phase_id' => $phase])],
                    ];
                    break;
            }

            $view->with('breadcrumbs', $breadcrumbs);
        } catch (BreadcrumbException $e) {
            // L'exception sera gérée par le render() défini dans BreadcrumbException
            throw $e;
        }
    }
}
