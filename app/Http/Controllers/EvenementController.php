<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvenementRequest;
use App\Http\Requests\UpdateEvenementRequest;
use App\Models\Evenement;
use App\Models\Phase;
use DateTime;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evenements = Evenement::latest()->paginate(13);
        return view('evenements.index', compact('evenements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('evenements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvenementRequest $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'type' => 'required',
            ]
        );

        //$datedebut = $request->datedebut;
        //$heuredebut = $request->heuredebut;
        //$dateTimeD = DateTime::createFromFormat('m/d/Y', $datedebut);
        //$formatDateDebut = $dateTimeD->format('Y-m-d');
        //$dateTimeDebut = ($formatDateDebut . ' ' . $heuredebut . ':00');

        //$datefin = $request->datefin;
        //$heurefin = $request->heurefin;
        //$dateTimeF = DateTime::createFromFormat('m/d/Y', $datefin);
        //$formatDateFin = $dateTimeF->format('Y-m-d');
        //$dateTimeFin = ($formatDateFin . ' ' . $heurefin . ':00');


        $evenements = Evenement::create(
            [
                'nom' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
                //'date_debut' => $dateTimeDebut,
                //'date_fin' => $dateTimeFin,
                'status' => 'en attente',
            ]
        );

        $autoCreate = 1;
        $evenements->auto_create = $autoCreate;
        $evenements->save();


        //$evenement_id = $evenement->id;
        //$type_event = $evenement->type;
        // $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // $charactersNumber = strlen($characters);
        // $codeLength = 3;
        // $slug = null;

        // do {
        //     $slug = '';
        //     for ($i = 0; $i < $codeLength; $i++) {
        //         $position = mt_rand(0, $charactersNumber - 1);
        //         $slug .= $characters[$position];
        //     }
        // } while (Phase::where('slug', $slug)->exists());

        // if ($type_event == 'Compétition') {
        //     $phase = Phase::create(
        //         [
        //             'nom' => $request->name,
        //             'description' => $request->description,
        //             'statut' => 'en attente',
        //             'slug' => $slug,
        //             'type' => 'Vote',
        //             'date_debut' => $dateTimeDebut,
        //             'date_fin' => $dateTimeFin,
        //             'evenement_id' => $evenement_id
        //         ]
        //     );
        // } else {
        //     $phase = Phase::create(
        //         [
        //             'nom' => $request->name,
        //             'description' => $request->description,
        //             'statut' => 'en attente',
        //             'slug' => $slug,
        //             'type' => 'Evaluation',
        //             'duree' => '01:00:00',
        //             'date_debut' => $dateTimeDebut,
        //             'date_fin' => $dateTimeFin,
        //             'evenement_id' => $evenement_id
        //         ]
        //     );
        // }

        session(['breadEvenement' => $evenements->id]);
        return redirect(route('phase.create', $evenements))->with('success', 'Evénement enregistré et ajout les details de la première phase');
    }

    /**
     * Display the specified resource.
     */
    public function show(Evenement $evenement)
    {
        $phases = $evenement->phases;
        return view('evenements.show', compact('evenement', 'phases'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evenement $evenement)
    {
        return view('evenements.edit', compact('evenement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEvenementRequest $request, Evenement $evenement)
    {
        $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'type' => 'required',
            ]
        );

        $evenement = Evenement::findOrFail($evenement->id);

        $datedebut = $request->datedebut;
        $heuredebut = $request->heuredebut;
        $dateTimeD = DateTime::createFromFormat('m/d/Y', $datedebut);
        $formatDateDebut = $dateTimeD->format('Y-m-d');
        $dateTimeDebut = ($formatDateDebut . ' ' . $heuredebut . ':00');

        $datefin = $request->datefin;
        $heurefin = $request->heurefin;
        $dateTimeF = DateTime::createFromFormat('m/d/Y', $datefin);
        $formatDateFin = $dateTimeF->format('Y-m-d');
        $dateTimeFin = ($formatDateFin . ' ' . $heurefin . ':00');


        $evenement->update(
            [
                'nom' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
                'date_debut' => $dateTimeDebut,
                'date_fin' => $dateTimeFin,
                'status' => 'en attente',
            ]
        );
        session(['breadEvenement' => $evenement->id]);

        return redirect(route('evenements.index'))->with('success', 'Modification reussie');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evenement $evenement)
    {
        $evenement->delete();
        return redirect()->route('evenements.index')->with('success', 'Evénement supprimé avec succès');
    }

    public function creationStep(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'type' => 'required',
            ]
        );

        $evenements = Evenement::create(
            [
                'nom' => $request->name,
                'description' => $request->description_event,
                'type' => $request->type_event,
                //'date_debut' => $dateTimeDebut,
                //'date_fin' => $dateTimeFin,
                'status' => 'en attente',
            ]
        );

        $autoCreate = 1;
        $evenements->auto_create = $autoCreate;
        $evenements->save();

        session(['breadEvenement' => $evenements->id]);

        $evenement_id = $evenements->id;
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 3;
        $slug = null;

        do {
            $slug = '';
            for ($i = 0; $i < $codeLength; $i++) {
                $position = mt_rand(0, $charactersNumber - 1);
                $slug .= $characters[$position];
            }
        } while (Phase::where('slug', $slug)->exists());

        $phase = Phase::create(
            [
                'nom' => $request->nom,
                'description' => $request->description,
                'statut' => 'en attente',
                'slug' => $slug,
                'type' => $request->type,
                'duree' => $request->duree,
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin,
                'evenement_id' => $evenements->id,
            ]

        );

        $autoCreate = 0;
        $evenement = Evenement::findOrFail($evenement_id);
        $evenement->auto_create = $autoCreate;
        $evenement->save();
        session(['breadEvenement' => $evenement->id]);
        return redirect()->route('evenements.show', $evenement_id)->with('success', 'Enregistrement reussi');
    }
}
