<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIntervenantPhaseRequest;
use App\Http\Requests\UpdateIntervenantPhaseRequest;
use App\Jobs\SendIntervenantMail;
use App\Mail\CandidatMail;
use App\Models\Intervenant;
use App\Models\IntervenantPhase;
use App\Models\Phase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class IntervenantPhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $intervenantPhase = IntervenantPhase::all();
        return view('intervenant.index', compact('intervenantPhase'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIntervenantPhaseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(IntervenantPhase $intervenantPhase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IntervenantPhase $intervenantPhase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIntervenantPhaseRequest $request, IntervenantPhase $intervenantPhase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IntervenantPhase $intervenantPhase)
    {
        //
    }

    // public function sendMail($id, $phase_id)
    // {
    //     $intervenant = Intervenant::findOrFail($id);
    //     $intervenantPhase = IntervenantPhase::where('intervenant_id', $id)->where('phase_id', $phase_id)->first();
    //     if ($intervenant && $intervenantPhase) {
    //         $objet = 'AWS test de niveau';
    //         $coupon = $intervenantPhase->coupon;
    //         $date = 'mardi 03 Août 2024';
    //         $email = $intervenant->email;
    //         Mail::to('glodykabengele55@gmail.com')->send(new CandidatMail($objet, $coupon, $date, $email));
    //     }
    // }

    // public function sendMailMany(Request $request)
    // {
    //     $phase_id = $request->phase;
    //     $dateTest = $request->dateTest;
    //     $heureTest = $request->heureTest;
    //     $objetTest = $request->objet;
    //     $firstCandidat = $request->candFirst;
    //     $lastCandidat = $request->candLast;
    //     $isVote = $request->isVote;
    //     $nonPresent = $request->nonPresent;

    //     $currentUrl = $request->fullUrl();
    //     $parsedUrl = parse_url($currentUrl);
    //     $hostPort = $parsedUrl['host'] . ':' . $parsedUrl['port'];
    //     $lien = $hostPort . '/votePad-form';

    //     $firstIntervenat = Intervenant::where('id', $firstCandidat)->pluck('noms')->first();
    //     $lastIntervenat = Intervenant::where('id', $lastCandidat)->pluck('noms')->first();

    //     $intervenantsSelected = Intervenant::whereBetween('noms', [$firstIntervenat, $lastIntervenat])->orderBy('noms')->get();

    //     // return response()->json([
    //     //     'intervenantsSelected' => $intervenantsSelected,
    //     // ]);
    //     //$intervenantPhases = IntervenantPhase::where('phase_id', $phase_id)->get();
    //     if ($intervenantsSelected) {
    //         foreach ($intervenantsSelected as $intervenant) {
    //             $intervenantPhase = IntervenantPhase::where('intervenant_id', $intervenant->id)->where('phase_id', $phase_id)->first();
    //             if ($intervenantPhase && $intervenantPhase->token == 0) {
    //                 $objet = $objetTest;
    //                 $coupon = $intervenantPhase->coupon;
    //                 $date = $dateTest;
    //                 $noms = $intervenant->noms;
    //                 $email = $intervenant->email;

    //                 Mail::to($email)->send(new CandidatMail($objet, $coupon, $date, $noms, $heureTest, $isVote, $lien, $nonPresent));
    //                 $mailEnvoye = $intervenantPhase->mail_send;
    //                 $intervenantPhase->mail_send = $mailEnvoye + 1;
    //                 $intervenantPhase->save();
    //             }
    //         }
    //         return redirect(route('phase.show', $phase_id))->with('success', 'Mails envoyés avec succès');
    //     }
    // }


    public function sendMailMany(Request $request)
    {
        $phase_id = $request->phase_id;
        $intervenantsSelected = $request->intervenants;
        $dateTest = $request->dateTest;
        $heureTest = $request->heureTest;
        $isVote = $request->isVote;
        $objet = $request->objet;

        $phase = Phase::find($phase_id);
        if (!$phase) {
            return response()->json(['error' => 'Phase introuvable.'], 404);
        }


        $currentUrl = $request->fullUrl();
        $parsedUrl = parse_url($currentUrl);
        $hostPort = $parsedUrl['host'] . (isset($parsedUrl['port']) ? ':' . $parsedUrl['port'] : '');
        $protocol = $request->getScheme();
        $lien = $protocol . '://' . $hostPort . '/momekano-form';

        if ($intervenantsSelected && is_array($intervenantsSelected)) {
            foreach ($intervenantsSelected as $intervenantData) {
                $intervenant = Intervenant::find($intervenantData['id']);
                if ($intervenant) {
                    SendIntervenantMail::dispatch($intervenant, $phase, $dateTest, $heureTest, $isVote, $lien, $objet);
                }
            }
            return response()->json(['message' => 'Mails envoyés avec succès en arrière-plan.'], 200);
        }
    }
}
