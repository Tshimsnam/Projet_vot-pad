<?php

namespace App\Jobs;

use App\Mail\CandidatMail;
use App\Models\IntervenantPhase;
use App\Models\Intervenant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class SendIntervenantMail implements ShouldQueue
{
    use Dispatchable, Queueable;

    protected $intervenant, $phase, $dateTest, $heureTest, $isVote, $lien, $objet;

    public function __construct($intervenant, $phase, $dateTest, $heureTest, $isVote, $lien, $objet)
    {
        $this->intervenant = $intervenant;
        $this->phase = $phase;
        $this->dateTest = $dateTest;
        $this->heureTest = $heureTest;
        $this->isVote = $isVote;
        $this->lien = $lien;
        $this->objet = $objet;
    }

    public function handle()
    {
        $intervenant = $this->intervenant;
        $phase = $this->phase;
        $objetTest = $this->objet;
        $nonPresent = 'exterieur';
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
}
