@extends('layout.navbar')
@section('content')
    {{-- <a class="btn btn-success" href="{{ route('championnat.index') }}">retour</a> --}}
<<<<<<< HEAD
    <h1>Modification des informations des joueurs</h1>
=======
    <h1>Modification des informationq de l'joueur</h1>
>>>>>>> 3636d3164105a06c5cd3cc82695d2cde70234ed8

    <form action="{{ route('joueur.update', ['joueur' => $joueur->id]) }}" method="POST">
        @csrf
        @method('put')
<<<<<<< HEAD
        <input type="text" name="nom" id="" value="{{ $joueur->nom }}" placeholder="Nom du joueur">
        <input type="text" name="prenom" id="" value="{{ $joueur->prenom }}" placeholder="Préom du joueur">
        <input type="text" name="email" id="" value="{{ $joueur->email }}"
            placeholder="Email du joueur">
        <input type="text" name="tel" id="" value="{{ $joueur->tel }}"
            placeholder="Numero de téléphone">
        <input type="text" name="sexe" id="" value="{{ $joueur->sexe }}" placeholder="Donner le sexe du joueur">
        <option value="">
            <select name="" id=""></select>
        </option>
        <input class="btn btn-success" type="submit" value="save">
    </form>

=======
        <input type="text" name="ville" id="" value="{{ $joueur->ville }}" placeholder="Ville de l'joueur">
        <input type="text" name="categorie" id="" value="{{ $joueur->categorie }}"
            placeholder="Categorie de l'joueur">
        <input type="text" name="championnat" id="" value="{{ $joueur->championnat }}"
            placeholder="championnat de l'joueur">
        <input class="btn btn-success" type="submit" value="save">
        <option value="">
            <select name="" id=""></select>
        </option>
    </form>
>>>>>>> 3636d3164105a06c5cd3cc82695d2cde70234ed8
@endsection
