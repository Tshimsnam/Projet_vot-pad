<?php

namespace App\Http\Controllers\api;

use App\Models\Jury;
use App\Models\Phase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return redirect(route('phase.show', $phaseId))->with('successDeleteJury', 'Suppression effectuée');
    }
    public function form(){
        return view('jurys.authenticate');
    }

    public function authenticate(Request $request){
        $coupon = $request->coupon;
        $jury = Jury::where('coupon', $coupon)->first();
        if (!$jury) {
            return response()->json([
                "error" => "le coupon est invalide"
            ]);
        }
        else {
            $JuryToken = $jury->token;
            if ($JuryToken != 0) {
                return response()->json([
                    "error"=>"ce coupon a été déjà utilisé."]);
            }
            else{
                $juryCoupon = $jury->coupon;
                $evenementId = $jury->evenement_id;
                $token = $jury->createToken($juryCoupon)->plainTextToken;
                $jury->token = $token;
                $jury->save();
                $phaseSlug = substr($juryCoupon, 0, 3);
                $phase = Phase::where('slug', $phaseSlug)->first();
            if ($phase->statut=='active') {
                return response()->json($phase);;
                }
            else {
                $message = 'Desolée, cette phase est '.$phase->statut;
                return $message;
                }


            }
        }


    }
}
