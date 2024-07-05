<?php

namespace App\Http\Controllers;

use App\Models\Jury;
use App\Models\Phase;
use App\Http\Requests\StoreJuryRequest;
use App\Http\Requests\UpdateJuryRequest;
use App\Models\JuryPhase;

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

        if ($typeVote == 'prive et public') {
            // Créer de nouveaux jurys privés
            $numberPrive = $request->nombre_prive;
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
            $numberPrive = $request->nombre_prive;
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
        } elseif ($typeVote == 'public') {

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

            $data = [
                'jury_id' => json_encode($juryIds),
                'phase_id' => $phaseId,
                'type' => $request->type,
                'ponderation_prive' => $request->ponderation_public,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }


        if ($pahseRecord) {
            // Mettre à jour l'enregistrement existant
            $pahseRecord->update($data);
        } else {
            // Créer un nouvel enregistrement
            $status = JuryPhase::insert($data);
        }

        return redirect(route('phase.show', $phaseId))->with('success', 'Insertion des jurys effectuée');
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
    public function destroy(Jury $jury)
    {
        //
    }
}
