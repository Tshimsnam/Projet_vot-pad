<?php
namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class BreadcrumbComposer
{
    public function compose(View $view)
    {
        $breadcrumbs = [];
        $evenement   = session('breadEvenement');
        $phase       = session('breadPhase');
        
        $routeName  = Route::currentRouteName();
        $parameters = Route::current()->parameters();

        switch ($routeName) {
            case 'dashboard':
                $breadcrumbs[] = ['title' => 'Dashboard', 'url' => route('dashboard')];
                break;

            case 'evenements.index':
                $breadcrumbs[] = ['title' => 'Evénements', 'url' => route('evenements.index')];
                break;

            case 'evenements.show':
                $evenementId = $parameters['evenement'] ?? null;
                if ($evenementId) {
                    $breadcrumbs[] = ['title' => 'Evénements', 'url' => route('evenements.index')];
                    $breadcrumbs[] = ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenementId])];
                }
                break;

            case 'phase.show':
                if (! isset($parameters['id'])) {
                    return redirect()->route('dashboard');
                }
                $phaseId = $parameters['id'];
                if (isset($evenement)) {
                    $breadcrumbs[] = ['title' => 'Evénements', 'url' => route('evenements.index')];
                    $breadcrumbs[] = ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])];
                    $breadcrumbs[] = ['title' => 'Détail Phase', 'url' => route('phase.show', ['id' => $phaseId])];
                }
                break;

            case 'evenements.create':
                $breadcrumbs[] = ['title' => 'Evénements', 'url' => route('evenements.index')];
                $breadcrumbs[] = ['title' => 'Configuration', 'url' => route('evenements.create')];
                break;

            case 'evenements.edit':
                if (! isset($evenement)) {
                    return redirect()->route('dashboard');
                }
                $breadcrumbs[] = ['title' => 'Evénements', 'url' => route('evenements.index')];
                $breadcrumbs[] = ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])];
                $breadcrumbs[] = ['title' => 'Modifier Evénement', 'url' => route('evenements.edit', ['evenement' => $evenement])];
                break;

            case 'phase.create':
                if (! isset($evenement)) {
                    return redirect()->route('dashboard');
                }
                $breadcrumbs[] = ['title' => 'Evénements', 'url' => route('evenements.index')];
                $breadcrumbs[] = ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])];
                $breadcrumbs[] = ['title' => 'Créer Phase', 'url' => route('phase.create', ['evenement_id' => $evenement])];
                break;

            case 'resultats.show':
                if (! isset($parameters['resultat'])) {
                    return redirect()->route('dashboard');
                }
                $resultatId = $parameters['resultat'];
                if (isset($phase)) {
                    $breadcrumbs[] = ['title' => 'Evénements', 'url' => route('evenements.index')];
                    $breadcrumbs[] = ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])];
                    $breadcrumbs[] = ['title' => 'Détail Phase', 'url' => route('phase.show', ['id' => $phase])];
                    $breadcrumbs[] = ['title' => 'Résultat', 'url' => route('resultats.show', ['resultat' => $resultatId])];
                }
                break;

            case 'restultatDetatil':
                if (! isset($parameters['interv_id'])) {
                    return redirect()->route('dashboard');
                }
                $intervId = $parameters['interv_id'];

                if (isset($phase)) {
                    $breadcrumbs[] = ['title' => 'Evénements', 'url' => route('evenements.index')];
                    $breadcrumbs[] = ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])];
                    $breadcrumbs[] = ['title' => 'Détail Phase', 'url' => route('phase.show', ['id' => $phase])];
                    $breadcrumbs[] = ['title' => 'Résultat', 'url' => route('resultats.show', ['resultat' => $phase])];
                    $breadcrumbs[] = [
                        'title' => 'Résultats Détail',
                        'url'   => route('restultatDetatil', ['phase_id' => $phase, 'interv_id' => $intervId]),
                    ];
                }
                break;

            case 'mail.view':
                if (! isset($phase)) {
                    return redirect()->route('dashboard');
                }
                $breadcrumbs[] = ['title' => 'Evénements', 'url' => route('evenements.index')];
                $breadcrumbs[] = ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])];
                $breadcrumbs[] = ['title' => 'Détail Phase', 'url' => route('phase.show', ['id' => $phase])];
                $breadcrumbs[] = ['title' => 'Gestion des mails', 'url' => route('mail.view', ['phase_id' => $phase])];
                break;

            default:
                return redirect()->route('dashboard'); // Redirection par défaut vers le dashboard
        }

        // Passer les breadcrumbs à la vue
        $view->with('breadcrumbs', $breadcrumbs ?? []);
    }

}
