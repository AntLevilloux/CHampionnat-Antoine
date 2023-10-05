<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\Matche;
use Illuminate\Http\Request;

class EquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matche = Matche::all();
        $equipe = Equipe::all();

        $playerCounts = [];
        $victoires = [];
        $defaites = [];
        $nul = [];

        foreach ($equipe as $equipes) {
            $victoires[$equipes->id] = 0;
            $defaites[$equipes->id] = 0;
            $nul[$equipes->id] = 0;

            foreach ($matche as $matches) {
                if ($matches->domicile == $equipes->id) {
                    if ($matches->but_domicile > $matches->but_visiteur) {
                        $victoires[$equipes->id] += 1;
                    } elseif ($matches->but_domicile < $matches->but_visiteur) {
                        $defaites[$equipes->id] += 1;
                    } else {
                        $nul[$equipes->id] += 1;
                    }
                } elseif ($matches->visiteur == $equipes->id) {
                    if ($matches->but_visiteur > $matches->but_domicile) {
                        $victoires[$equipes->id] += 1;
                    } elseif ($matches->but_visiteur < $matches->but_domicile) {
                        $defaites[$equipes->id] += 1;
                    } else {
                        $nul[$equipes->id] += 1;
                    }
                }
            }

            $playerCount = Joueur::where('equipe_id', $equipes->id)->count();
            $playerCounts[$equipes->id] = $playerCount;
        }

        return view('equipe.equipeliste', compact('equipe', 'matche', 'playerCounts', 'victoires', 'defaites', 'nul'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipe.equipecreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $ville = $data["ville"];
        $cat = $data["categorie"];
        $champ = $data["championnat"];

        $equipe = new Equipe;
        $equipe->ville = $ville;
        $equipe->categorie = $cat;
        $equipe->championnat = $champ;
        $equipe->save();

        return redirect()->route('equipe.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $equipe = Equipe::Find($id);
        $player = Joueur::where('equipe_id', $equipe->id)->get();

        return view('equipe.equipemodification', compact('player', 'equipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $equipe = Equipe::Find($id);

        $validatedData = $request->all();


        $equipe->ville = $validatedData['ville'];
        $equipe->categorie = $validatedData['categorie'];
        $equipe->championnat = $validatedData['championnat'];

        $equipe->save();

        return redirect()->route('championnat.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equipe = Equipe::findOrFail($id);

        $equipe->delete();

        return redirect()->route('equipe.index');
    }

}
