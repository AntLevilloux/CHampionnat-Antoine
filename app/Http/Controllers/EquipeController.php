<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Mail\InfoMail;
use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\Matche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $data = $request->validate([
            'ville' => 'required|string',
            'categorie' => 'required|string',
            'championnat' => 'required|string',
        ]);

        $equipe = new Equipe;
        $equipe->ville = $data['ville'];
        $equipe->categorie = $data['categorie'];
        $equipe->championnat = $data['championnat'];
        $equipe->save();

        Mail::to(Auth::user())->send(new InfoMail($equipe));

        return redirect()->route('equipe.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Equipe $equipe)
    {
        return view('equipe.equipeshow', compact('equipe'));
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
        $equipe = Equipe::find($id);

        if (!$equipe) {
            return redirect()->route('equipe.index')->with('error', 'Équipe introuvable.');
        }

        $validatedData = $request->validate([
            'ville' => 'required|string',
            'categorie' => 'required|string',
            'championnat' => 'required|string',
        ]);

        $equipe->ville = $validatedData['ville'];
        $equipe->categorie = $validatedData['categorie'];
        $equipe->championnat = $validatedData['championnat'];
        $equipe->save();

        //Mail::to(Auth::user())->send(new InfoMail());

        return redirect()->route('equipe.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipe $equipe)
    {
        $equipe->delete();

        return redirect()->route('equipe.index');
    }

}
