<?php

namespace App\Http\Controllers;

use App\Models\Jury;
use App\Models\Phase;
use App\Models\Evenement;
use App\Models\JuryPhase;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJuryRequest;
use App\Http\Requests\UpdateJuryRequest;

class JuryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreJuryRequest $request)
    {
        $phaseId = (int) $request->phase;
        $phase = Phase::find($phaseId);
        $slug = $phase->slug;
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 3;
        $coupon = null;
        $now = date('Y-m-d H:i:s');

        $request->validate([
            'type' => 'required',
        ]);

        if ($phase->type == 'Vote' || $phase->type == 'vote') {

            // Vérifier si la phase_id existe déjà dans la table jury_phases
            $pahseRecord = JuryPhase::where('phase_id', $phaseId)->first();

            $juryIds = null;
            if ($pahseRecord) {
                $juryIds = $pahseRecord->jury_id;

                if (is_string($juryIds)) {
                    $juryIds = json_decode($juryIds, true);
                }
            } else {
                $juryIds = [];
            }

            $typeVote = $request->type;
            $numberPrive = $request->nombre_prive;
            $numberPublic = $request->ajoutPublic;

            if ($typeVote == 'prive et public') {
                // Créer de nouveaux jurys privés
                for ($i = 0; $i < $numberPrive; $i++) {
                    do {
                        $coupon = '';
                        for ($j = 0; $j < $codeLength; $j++) {
                            $position = mt_rand(0, $charactersNumber - 1);
                            $coupon .= $characters[$position];
                        }
                    } while (Jury::where('coupon', $coupon)->exists());
                    $couponPhase = $slug . $coupon;

                    $jury = Jury::create([
                        'coupon' => $couponPhase,
                        'type' => 'prive',
                        'is_use' => 0,
                        'token' => '0',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);

                    $juryIds[] = $jury->id;
                }
                // Créer de nouveaux jurys publics
                if ($numberPublic != 0) {
                    do {
                        $coupon = '';
                        for ($j = 0; $j < $codeLength; $j++) {
                            $position = mt_rand(0, $charactersNumber - 1);
                            $coupon .= $characters[$position];
                        }
                    } while (Jury::where('coupon', $coupon)->exists());
                    $couponPhase = $slug . $coupon;
                    $jury = Jury::create([
                        'coupon' => $couponPhase,
                        'type' => 'public',
                        'is_use' => 0,
                        'token' => '0',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);

                    $juryIds[] = $jury->id;
                }

                $data = [
                    'jury_id' => json_encode($juryIds),
                    'phase_id' => $phaseId,
                    'type' => $request->type,
                    'ponderation_prive' => $request->ponderation_prive,
                    'ponderation_public' => $request->ponderation_public,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            } elseif ($typeVote == 'prive') {
                for ($i = 0; $i < $numberPrive; $i++) {
                    do {
                        $coupon = '';
                        for ($j = 0; $j < $codeLength; $j++) {
                            $position = mt_rand(0, $charactersNumber - 1);
                            $coupon .= $characters[$position];
                        }
                    } while (Jury::where('coupon', $coupon)->exists());
                    $couponPhase = $slug . $coupon;

                    $jury = Jury::create([
                        'coupon' => $couponPhase,
                        'type' => 'prive',
                        'is_use' => 0,
                        'token' => '0',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);

                    $juryIds[] = $jury->id;

                    $data = [
                        'jury_id' => json_encode($juryIds),
                        'phase_id' => $phaseId,
                        'type' => $request->type,
                        'ponderation_prive' => $request->ponderation_prive,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
                if ($numberPrive == 0) {
                    $data = [
                        'jury_id' => json_encode($juryIds),
                        'phase_id' => $phaseId,
                        'type' => $request->type,
                        'ponderation_prive' => $request->ponderation_prive,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            } elseif ($typeVote == 'public') {

                if ($numberPublic != 0) {
                    do {
                        $coupon = '';
                        for ($j = 0; $j < $codeLength; $j++) {
                            $position = mt_rand(0, $charactersNumber - 1);
                            $coupon .= $characters[$position];
                        }
                    } while (Jury::where('coupon', $coupon)->exists());
                    $couponPhase = $slug . $coupon;
                    $jury = Jury::create([
                        'coupon' => $couponPhase,
                        'type' => 'public',
                        'is_use' => 0,
                        'token' => '0',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);

                    $juryIds[] = $jury->id;
                }

                $data = [
                    'jury_id' => json_encode($juryIds),
                    'phase_id' => $phaseId,
                    'type' => $request->type,
                    'ponderation_public' => $request->ponderation_public,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            //return dd("prive:" . $numberPrive . " public:" . $numberPublic);
            if ($pahseRecord) {
                // Mettre à jour l'enregistrement existant
                $pahseRecord->update($data);
                if ($numberPrive == 0 && $numberPublic == 0) {
                    return redirect(route('phase.show', $phaseId))->with('successModifJury', 'Modification effectuée');
                } else {
                    return redirect(route('phase.show', $phaseId))->with('successInsertJury', 'Insertion effectuée');
                }
            } else {
                // Créer un nouvel enregistrement
                $status = JuryPhase::insert($data);
                return redirect(route('phase.show', $phaseId))->with('successInsertJury', 'Insertion effectuée');
            }
        } else {
            do {
                $coupon = '';
                for ($j = 0; $j < $codeLength; $j++) {
                    $position = mt_rand(0, $charactersNumber - 1);
                    $coupon .= $characters[$position];
                }
                $couponPhase = $slug . $coupon;
            } while (Jury::where('coupon', $couponPhase)->exists());
            $nom = $request->noms;
            //dd($noms);
            $jury = Jury::create([
                'coupon' => $couponPhase,
            ]);
            $jury->noms = $nom;
            $jury->save();
            $jury_phase = JuryPhase::create([
                'jury_id' => $jury->id,
                'phase_id' => $phaseId,
                'type' => 'entretien',
            ]);
            if ($jury_phase) {
                return redirect(route('phase.show', $phaseId))->with('successInsertJury', 'Insertion effectuée');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Jury $jury)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jury $jury)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJuryRequest $request, Jury $jury)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jury $jury, $phaseId)
    {
        //
        $jury->delete();
        return redirect(route('phase.show', $phaseId))->with('successDeleteJury', 'Suppression effectuée');
    }

    public function form()
    {
        return view('jurys.authenticate');
    }
}
