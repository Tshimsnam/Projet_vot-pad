<?php
namespace App\Http\Controllers;

use App\Exports\VoteExport;
use App\Models\Critere;
use App\Models\Evenement;
use App\Models\Groupe;
use App\Models\Intervenant;
use App\Models\IntervenantPhase;
use App\Models\Jury;
use App\Models\JuryPhase;
use App\Models\Phase;
use App\Models\PhaseCritere;
use App\Models\Vote;
use Maatwebsite\Excel\Facades\Excel;

class VoteExcelController extends Controller
{
    public function export_excel($phase_id)
    {
        $phase_nom         = Phase::find($phase_id)->nom;
        $intervenantPhases = IntervenantPhase::where('phase_id', $phase_id)->get();
        $criterePhases     = PhaseCritere::where('phase_id', $phase_id)->get();
        $numberCritere     = $criterePhases->count();
        $ponderationTotale = 0;
        foreach ($criterePhases as $key => $criterePhase) {
            $critere = Critere::findOrFail($criterePhase->critere_id);
            $ponderationTotale += $critere->ponderation;
        }

        $juryPhase = JuryPhase::where('phase_id', $phase_id)->first();
        if ($juryPhase) {
            $ponderationJuryPublic = $juryPhase->ponderation_public;
            $ponderationJuryPrive  = $juryPhase->ponderation_prive;
            $typeVote              = $juryPhase->type;
        } else {
            $ponderationJuryPublic = 0;
            $ponderationJuryPrive  = 0;
            $typeVote              = 'prive et public';
        }

        $intervenants        = [];
        $totalVoteByCandidat = 0;
        $totalVote           = 0;
        $nombreMaxJury       = 0;
        foreach ($intervenantPhases as $intervenantPhase) {
            $intervenant                     = Intervenant::find($intervenantPhase->intervenant_id);
            $groupe                          = Groupe::find($intervenant->groupe_id);
            $intervenant->intervenantPhaseId = $intervenantPhase->id;

            $JuryByCandidat = Vote::where('intervenant_phase_id', $intervenantPhase->id)
                ->distinct('jury_phase_id')
                ->pluck('jury_phase_id');

            $votes = Vote::whereIn('jury_phase_id', $JuryByCandidat)
                ->where('intervenant_phase_id', $intervenantPhase->id)
                ->get();

            $jurys = Jury::whereIn('id', $JuryByCandidat)->get()->keyBy('id');

            foreach ($votes as $vote) {
                $jury            = $jurys->get($vote->jury_phase_id);
                $vote->jury_type = $jury ? $jury->type : null;
            }

            $sommeByType = $votes->groupBy('jury_type')->map(function ($group) {
                return $group->sum('cote');
            });

            $moyenne = 0;
            foreach ($votes as $vote) {
                $moyenne += $vote->cote;
            }

            $decisionOui = $votes->filter(function ($vote) {
                return $vote->decision === 'oui';
            })->count();
            $decisionOui = $decisionOui / $numberCritere;

            $decisionNon = $votes->filter(function ($vote) {
                return $vote->decision === 'non';
            })->count();
            $decisionNon = $decisionNon / $numberCritere;

            $decisionAttente = $votes->filter(function ($vote) {
                return $vote->decision === 'attente';
            })->count();
            $decisionAttente = $decisionAttente / $numberCritere;

            $numberVoteByInter = $votes->count();

            $totalVoteByCandidat = $moyenne;

            $nombreJuryIntervenant = $JuryByCandidat->count();
            if ($nombreJuryIntervenant > $nombreMaxJury) {
                $nombreMaxJury = $nombreJuryIntervenant;
            }

            if ($numberVoteByInter != 0) {
                $JuryByCandidat = $numberVoteByInter / $numberCritere;
            } else {
                $JuryByCandidat = 0;
            }
            $sommeByTypePrive  = $sommeByType->get('prive', 0);
            $sommeByTypePublic = $sommeByType->get('public', 0);

            if ($typeVote == 'entretien' || $typeVote == 'Entretien') {
                $cote = $totalVoteByCandidat;
                $totalVote += $cote;
            } else if ($typeVote == 'prive et public') {
                $sommeByTypePrive  = round(($sommeByTypePrive) * ($ponderationJuryPrive / 100), 2);
                $sommeByTypePublic = round(($sommeByTypePublic) * ($ponderationJuryPublic / 100), 2);
                $cote              = $sommeByTypePublic + $sommeByTypePrive;
                $totalVote += $cote;
            } else {
                $totalVote += $totalVoteByCandidat;
                $cote = $sommeByTypePublic + $sommeByTypePrive;
            }

            $intervenant->cote            = $cote;
            $intervenant->nombreJury      = $JuryByCandidat;
            $intervenant->votePublic      = $sommeByTypePublic;
            $intervenant->votePrive       = $sommeByTypePrive;
            $intervenant->decisionOui     = $decisionOui;
            $intervenant->decisionNon     = $decisionNon;
            $intervenant->decisionAttente = $decisionAttente;

            $intervenants[] = $intervenant;
        }

        foreach ($intervenants as $intervenant) {
            if ($totalVote != 0) {
                $pourcentage = 0;
                if ($intervenant->nombreJury) {
                    $pourcentage = ($intervenant->cote * 100) / ($ponderationTotale * $intervenant->nombreJury);
                }
                $intervenant->pourcentage = round($pourcentage, 2);
                $intervenant->ponderation = ($ponderationTotale * $JuryByCandidat);
            } else {
                $intervenant->pourcentage = 0;
                $intervenant->ponderation = 0;
            }
        }

        $intervenants = array_filter($intervenants, function ($intervenant) {
            return $intervenant->nombreJury > 0;
        });

        usort($intervenants, function ($a, $b) {
            return $b->pourcentage - $a->pourcentage;
        });
        $phase         = Phase::findOrFail($phase_id);
        $evenement     = Evenement::findOrFail($phase->evenement_id);
        $evenement_nom = $evenement->nom;

        //return response()->json($evenement_nom);

        return Excel::download(new VoteExport($intervenants, $phase_nom, $evenement_nom), 'rapportVote.xlsx');
    }
}
