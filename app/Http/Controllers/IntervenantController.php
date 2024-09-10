<?php

namespace App\Http\Controllers;

use App\Models\Phase;
use App\Models\Groupe;
use App\Models\Intervenant;
use Illuminate\Http\Request;
use App\Models\IntervenantPhase;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Spatie\SimpleExcel\SimpleExcelReader;
use App\Http\Requests\StoreIntervenantRequest;
use App\Http\Requests\UpdateIntervenantRequest;
use Illuminate\Support\Facades\Cookie;

class IntervenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $intervenants = Intervenant::latest()->paginate(13);
        $intervenantPhaseCount = [];
        foreach ($intervenants as $intervenant) {
            $intervenantPhaseCount[$intervenant->id] = $intervenant->phases->count();
        }
        return view('intervenants.index', compact('intervenants', 'intervenantPhaseCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $phases = Phase::latest()->get();
        return view('intervenants.create', compact('phases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIntervenantRequest $request)
    {
        $phaseId = (int) $request->phase;
        $phase = Phase::find($phaseId);
        $slug = $phase->slug;
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 3;
        $coupon = null;
        $isVote = $request->isVote;
        $now = date('Y-m-d H:i:s');
        $data = [];
        if ($isVote == 1) {
            if ($request->image === null) {
                $intervenant = Intervenant::where('email', $request->email)->first();
                if (!$intervenant) {
                    $intervenant = Intervenant::create([
                        'noms' => $request->name,
                        'email' => $request->email,
                        'telephone' => $request->telephone,
                        'genre' => $request->genre,
                    ]);
                }
                $intervenantId = $intervenant->id;
                $intervenantPhase = IntervenantPhase::where('intervenant_id', $intervenantId)->where('phase_id', $phaseId)->first();
                if (!$intervenantPhase) {
                    do {
                        $coupon = '';
                        for ($i = 0; $i < $codeLength; $i++) {
                            $position = mt_rand(0, $charactersNumber - 1);
                            $coupon .= $characters[$position];
                        }
                        $couponPhase = $slug . $coupon;
                    } while (IntervenantPhase::where('coupon', $couponPhase)->exists());
                    
                    $intervenantPhaseNew = IntervenantPhase::create([
                        'intervenant_id' => $intervenantId,
                        'phase_id' => $phaseId,
                        'coupon' => $couponPhase,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            } else {
                $nom = $request->name;
                $imageName = time() . $nom . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $intervenant = Intervenant::where('email', $request->email)->first();
                if (!$intervenant) {
                    $intervenant = Intervenant::create([
                        'noms' => strtolower($request->name),
                        'email' => $request->email,
                        'telephone' => $request->telephone,
                        'genre' => $request->genre,
                        'image' => 'images/' . $imageName,
                    ]);
                }
                $intervenantId = $intervenant->id;
                $intervenantPhase = IntervenantPhase::where('intervenant_id', $intervenantId)->where('phase_id', $phaseId)->first();
                if (!$intervenantPhase) {
                    do {
                        $coupon = '';
                        for ($i = 0; $i < $codeLength; $i++) {
                            $position = mt_rand(0, $charactersNumber - 1);
                            $coupon .= $characters[$position];
                        }
                        $couponPhase = $slug . $coupon;
                    } while (IntervenantPhase::where('coupon', $couponPhase)->exists());

                    $intervenantPhaseNew = IntervenantPhase::create([
                        'intervenant_id' => $intervenantId,
                        'phase_id' => $phaseId,
                        'coupon' => $couponPhase,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        } else {
            $file = $request->file('fichier');
            $dataExcell = Excel::toArray([], $file)[0];

            $dataExcell = array_slice($dataExcell, 1);
            foreach ($dataExcell as $row) {
                $intervenant = Intervenant::where('email', $row['1'])->first();
                if (!$intervenant) {
                    $intervenant = Intervenant::create([
                        'noms' => strtolower($row[0]),
                        'email' => $row[1],
                        'telephone' => $row[2],
                        'genre' => $row[3]
                    ]);
                }
                $intervenantId = $intervenant->id;
                $intervenantPhase = IntervenantPhase::where('intervenant_id', $intervenantId)->where('phase_id', $phaseId)->first();
                if (!$intervenantPhase) {
                    do {
                        $coupon = '';
                        for ($i = 0; $i < $codeLength; $i++) {
                            $position = mt_rand(0, $charactersNumber - 1);
                            $coupon .= $characters[$position];
                        }
                        $couponPhase = $slug . $coupon;
                    } while (IntervenantPhase::where('coupon', $couponPhase)->exists());

                    $intervenantPhaseNew = IntervenantPhase::create([
                        'intervenant_id' => $intervenantId,
                        'phase_id' => $phaseId,
                        'coupon' => $couponPhase,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }

        if ($intervenantPhaseNew) {
            if ($isVote == 1) {
                return redirect(route('phase.show', $phaseId))->with('successCand', 'Insertion effectuée');
            } else {
                $insertionsCount = count($data);
                return redirect(route('phase.show', $phaseId))->with('successCand', 'Insertion effectuée :  lignes');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Intervenant $intervenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Intervenant $intervenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIntervenantRequest $request, Intervenant $intervenant)
    {
        $phaseId = (int) $request->phase;
        if ($request->image === null) {
            $status = $intervenant->update([
                'noms' => $request->name,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'genre' => $request->genre,
            ]);
        } else {
            $nom = $request->name;
            $imageName = time() . $nom . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $status = $intervenant->update([
                'noms' => $request->name,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'genre' => $request->genre,
                'image' => 'images/' . $imageName,
            ]);
        }

        if ($status) {
            return redirect(route('phase.show', $phaseId))->with('successCand', 'Mise à jour effectuée');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Intervenant $intervenant, $phaseId)
    {
        $intervenatId = $intervenant->id;
        $intervenantPhase = IntervenantPhase::where('intervenant_id', $intervenatId)->first();
        $intervenantPhase->delete();
        return redirect(route('phase.show', $phaseId))->with('successCand', 'Suppression effectuée');
    }

    public function form()
    {
        return view('intervenants.authenticate');
    }

    public function authenticate(Request $request)
    {
        $email = $request->email;
        $coupon = $request->coupon;
        $intervenant = Intervenant::select('id', 'email')->where('email', $email)->first();

        if (!$intervenant) {
            return redirect(route('form-authenticate'))->with('unsuccess', 'L\'adresse email insérée est invalide.');
        } else {
            $intervenantId = $intervenant->id;
            $intervenantPhase = IntervenantPhase::where('intervenant_id', $intervenantId)->where('coupon', $coupon)->first();
            if (!$intervenantPhase) {
                return redirect(route('form-authenticate'))->with('unsuccess', 'Le coupon inséré est invalide.');
            } else {
                $intervenantToken = $intervenantPhase->token;
                if ($intervenantToken != 0) {
                    $intervenantPhaseCoupon = $intervenantPhase->coupon;
                    $phaseSlug = substr($intervenantPhaseCoupon, 0, 3);
                    $phase = Phase::select('id')->where('slug', $phaseSlug)->first();
                    $IdPhase = $phase->id;
                    $IdIntervenant = $intervenant->id;

                    Session::put('phase_id', $IdPhase);
                    Session::put('intervenant_id', $IdIntervenant);

                    // dd(session('IdPhase'));

                    return to_route('reponses.index')->with(compact('phase', 'intervenant'));
                } else {
                    $intervenantPhaseCoupon = $intervenantPhase->coupon;
                    $token = $intervenantPhase->createToken($intervenantPhaseCoupon)->plainTextToken;
                    $intervenantPhase->token = $token;
                    $intervenantPhase->save();
                    $phaseSlug = substr($intervenantPhaseCoupon, 0, 3);
                    $phase = Phase::select('id')->where('slug', $phaseSlug)->first();
                    $IdPhase = $phase->id;
                    $IdIntervenant = $intervenant->id;

                    Session::put('phase_id', $IdPhase);
                    Session::put('intervenant_id', $IdIntervenant);

                    return to_route('reponses.create')->with(compact('phase', 'intervenant'));
                }
            }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('form-authenticate');
    }
}
