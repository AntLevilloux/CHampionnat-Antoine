<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Joueur;
use Illuminate\Http\Request;

class JoueurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipes = Equipe::all();
        $eqjoueurs = [];

        foreach ($equipes as $equipe) {
            $joueursEquipe = Joueur::where('equipe_id', $equipe->id)->get();

            $eqjoueurs[] = [
                'equipe' => $equipe,
                'joueurs' => $joueursEquipe,
            ];
        }

        return view('joueur.joueurliste', compact('eqjoueurs'));
    }



    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $equipes = Equipe::all();
        return view('joueur.joueurcreate', compact('equipes'));
    }


    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'tel' => 'required',
            'equipe_id' => 'required',
            'sexe' => 'required|in:0,1',
        ]);

        $joueur = new Joueur();
        $joueur->nom = $request->nom;
        $joueur->prenom = $request->prenom;
        $joueur->email = $request->email;
        $joueur->tel = $request->tel;
        $joueur->equipe_id = $request->equipe_id;
        $joueur->sexe = $request->sexe;

        $joueur->save();

        return redirect()->route('joueur.index')->with('success', 'Le joueur a été créé avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Joueur $joueur)
    {
        return view('joueur.joueurshow', compact('joueur'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $joueur = Joueur::Find($id);
        $equipes = Equipe::all();
        return view('joueur.joueurmodification', compact('joueur', 'equipes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $joueur = Joueur::find($id);

        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'tel' => 'required',
            'equipe_id' => 'required',
            'sexe' => 'required|in:0,1',
        ]);

        $joueur->nom = $request->nom;
        $joueur->prenom = $request->prenom;
        $joueur->email = $request->email;
        $joueur->tel = $request->tel;
        $joueur->equipe_id = $request->equipe_id;
        $joueur->sexe = $request->sexe;

        $joueur->save();

        return redirect()->route('joueur.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Joueur $joueur)
    {
            $joueur->delete();
            return redirect()->route('joueur.index');
    }
}
