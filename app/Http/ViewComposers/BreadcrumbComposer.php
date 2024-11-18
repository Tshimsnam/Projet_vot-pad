<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Route;

class BreadcrumbComposer
{
    public function compose(View $view)
    {

        $breadcrumbs = [];
        $evenement = session('breadEvenement');
        $phase = session('breadPhase');
        switch (Route::currentRouteName()) {
            case 'dashboard':
                $breadcrumbs = [
                    ['title' => 'Dashboard', 'url' => route('dashboard')],
                ];
                break;

            case 'evenements.index':
                $breadcrumbs = [
                    ['title' => 'Evénements', 'url' => route('evenements.index')]
                ];
                break;

            case 'evenements.show':
                $evenement = Route::current()->parameter('evenement');
                $breadcrumbs = [
                    ['title' => 'Evénements', 'url' => route('evenements.index')],
                    ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])]
                ];
                break;

            case 'phase.show':
                $phase = Route::current()->parameter('id');
                $breadcrumbs = [
                    ['title' => 'Evénements', 'url' => route('evenements.index')],
                    ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])],
                    ['title' => 'Détail Phase', 'url' => route('phase.show', ['id' => $phase])],
                ];
                break;

            case 'evenements.create':
                $breadcrumbs = [
                    ['title' => 'Evénements', 'url' => route('evenements.index')],
                    ['title' => 'Configuration', 'url' => route('evenements.create')]
                ];
                break;

            case 'evenements.edit':
                $breadcrumbs = [
                    ['title' => 'Evénements', 'url' => route('evenements.index')],
                    ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])],
                    ['title' => 'Modifier Evénement', 'url' => route('evenements.edit', ['evenement' => $evenement])]
                ];
                break;

            case 'phase.create':
                $breadcrumbs = [
                    ['title' => 'Evénements', 'url' => route('evenements.index')],
                    ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])],
                    ['title' => 'Créer Phase', 'url' => route('phase.create', ['evenement_id' => $evenement])]
                ];
                break;

            case 'resultats.show':

                $resultat = Route::current()->parameter('resultat');
                $breadcrumbs = [
                    ['title' => 'Evénements', 'url' => route('evenements.index')],
                    ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])],
                    ['title' => 'Détail Phase', 'url' => route('phase.show', ['id' => $phase])],
                    ['title' => 'Résultat', 'url' => route('resultats.show', ['resultat' => $resultat])]
                ];
                break;

            case 'results':

                $resultat = Route::current()->parameter('phase');
                $breadcrumbs = [
                    ['title' => 'Evénements', 'url' => route('evenements.index')],
                    ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])],
                    ['title' => 'Détail Phase', 'url' => route('phase.show', ['id' => $phase])],
                    ['title' => 'Résultat', 'url' => route('resultats.show', ['resultat' => $resultat])]
                ];
                break;

            case 'mail.view':
                $breadcrumbs = [
                    ['title' => 'Evénements', 'url' => route('evenements.index')],
                    ['title' => 'Phases', 'url' => route('evenements.show', ['evenement' => $evenement])],
                    ['title' => 'Détail Phase', 'url' => route('phase.show', ['id' => $phase])],
                    ['title' => 'Gestion des mails', 'url' => route('mail.view', ['phase_id' => $phase])]
                ];
                break;
        }




        $view->with('breadcrumbs', $breadcrumbs);
    }
}
