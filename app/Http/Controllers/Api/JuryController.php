<?php

namespace App\Http\Controllers\api;

use App\Models\Jury;
use App\Models\Phase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;


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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jury $jury, $phaseId)
    {
        $jury->delete();
        return response()->json(['Suppression effectuée']);
    }

    public function authenticate(Request $request)
    {
        $coupon = $request->coupon;
        $identifiant = $request->identifiant;
        $jury = Jury::where('coupon', $coupon)->first();
        if (!$jury) {
            return response()->json([
                "error" => "le coupon est invalide"
            ],400);
        } else {

            $type = $jury->type;
            if ($type == "public") {
                return $this->publicAuthenticate($jury, $identifiant);
            } else if ($type == "prive") {
                return $this->privateAuthenticate($jury);
            } else {
            }
        }
    }

    private function publicAuthenticate(Jury $jury, $identifiant)
    {
        $juryCoupon = $jury->coupon;
        if($identifiant == null)
        {
            return response()->json([
                "error" => "Desole, votre identifiant est invalide ou null",
            ],400
        );
        }
        $juryExistant = Jury::where('coupon', $juryCoupon)->where('identifiant', $identifiant)->first();
        if ($juryExistant) {
            return response()->json([
                "error" => "Desole, vous ne pouvez plus acceder a ce vote!!!",
            ],400
        );

        }
        $phaseSlug = substr($juryCoupon, 0, 3);
        $phase = Phase::where('slug', $phaseSlug)->first();
        if ($phase->statut == 'En cours') {
            $userData = array('coupon' => $juryCoupon, 'identifiant' => $identifiant, 'type' => 'public');
            $newJury = Jury::create($userData);
            $token = $newJury->createToken($juryCoupon)->plainTextToken;
            $newJury->token = $token;
            $getNumber = $jury->is_use;
            $jury->is_use = $getNumber + 1;
            $jury->save();
            $newJury->save();
            return response()->json(["phase" => $phase, "token" => $token]);;
        } else {
            $message = 'Desolé, cette phase est ' . $phase->statut;
            return $message;
        }
    }

    private function privateAuthenticate(Jury $jury)
    {
        $JuryToken = $jury->token;
        if ($JuryToken != 0) {
            return response()->json([
                "error" => "ce coupon a été déjà utilisé."
            ]);
        } else {
            $juryCoupon = $jury->coupon;
            $phaseSlug = substr($juryCoupon, 0, 3);
            $phase = Phase::where('slug', $phaseSlug)->first();
            if ($phase->statut == 'En cours') {
                $token = $jury->createToken($juryCoupon)->plainTextToken;
                $jury->token = $token;
                $jury->is_use = 1;
                $jury->save();
                return response()->json(["phase" => $phase, "token" => $token]);;
            } else {
                $message = 'Desolée, cette phase est ' . $phase->statut;
                return $message;
            }
        }
    }
}
