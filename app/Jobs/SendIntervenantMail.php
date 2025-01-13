<?php

namespace App\Jobs;

use App\Models\Phase;
use App\Mail\CandidatMail;
use App\Models\Intervenant;
use Illuminate\Bus\Queueable;
use App\Models\IntervenantPhase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendIntervenantMail implements ShouldQueue
{
    use Dispatchable, Queueable;

    protected $intervenantId, $phaseId, $dateTest, $heureTest, $isVote, $lien, $objet;

    public function __construct($intervenantId, $phaseId, $dateTest, $heureTest, $isVote, $lien, $objet)
    {
        $this->intervenantId = $intervenantId;
        $this->phaseId = $phaseId;
        $this->dateTest = $dateTest;
        $this->heureTest = $heureTest;
        $this->isVote = $isVote;
        $this->lien = $lien;
        $this->objet = $objet;
    }

    public function handle()
    {
        $intervenantId = $this->intervenantId;
        $phaseId = $this->phaseId;
        $objetTest = $this->objet;
        $nonPresent = 'exterieur';
        $intervenant = Intervenant::find($intervenantId);
        $phase = Phase::find($phaseId);

        $intervenantPhase = IntervenantPhase::where('intervenant_id', $intervenant->id)
            ->where('phase_id', $phase->id)
            ->first();

        if ($intervenantPhase) {
            $objet = $objetTest;
            $coupon = $intervenantPhase->coupon;
            $date = $this->dateTest;
            $noms = $intervenant->noms;
            $email = $intervenant->email;

            Mail::to($email)->send(new CandidatMail($objet, $coupon, $date, $noms, $this->heureTest, $this->isVote, $this->lien, $nonPresent));
            $intervenantPhase->increment('mail_send');
        }
    }

    // Méthodes accessoires

    public function getPhaseId()
    {
        return $this->phaseId;
    }
}
