<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Jury;
use App\Models\JuryPhase;
use App\Models\Phase;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class QRCodeController extends Controller
{
    public function index($jury)
    {
        $phase_id = (int) $jury;
        $juryPhases = JuryPhase::where('phase_id', $phase_id)->get();
        $phase = Phase::find($phase_id);
        $evenement = Evenement::find($phase->evenement_id);

        foreach ($juryPhases as $juryPhase) {
            if (is_string($juryPhase->jury_id) && json_decode($juryPhase->jury_id, true) !== null) {
                $juryIds = json_decode($juryPhase->jury_id, true);
            } else {
                $juryIds = $juryPhase->jury_id;
            }

            if (is_array($juryIds)) {
                foreach ($juryIds as $juryId) {
                    $jury = Jury::find($juryId);
                    if ($jury) {
                        $jury->event_nom = $evenement->nom;
                        $jurys[] = $jury;
                    }
                }
            } else {
                $jury = Jury::find($juryIds);
                if ($jury) {
                    $jury->event_nom = $evenement->nom;
                    $jurys[] = $jury;
                }
            }
        }
        return view('codes.qrcodes', compact('jurys'));
    }
}
