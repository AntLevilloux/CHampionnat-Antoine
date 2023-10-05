@extends('layout.navbar')
@section('content')
    {{-- <a class="btn btn-success" href="{{ route('championnat.index') }}">retour</a> --}}
    <h1>Modification des informationq de l'equipe</h1>

    <form action="{{ route('equipe.update', ['equipe' => $equipe->id]) }}" method="POST">
        @csrf
        @method('put')
        <input type="text" name="ville" id="" value="{{ $equipe->ville }}" placeholder="Ville de l'equipe">
        <input type="text" name="categorie" id="" value="{{ $equipe->categorie }}"
            placeholder="Categorie de l'equipe">
        <input type="text" name="championnat" id="" value="{{ $equipe->championnat }}"
            placeholder="championnat de l'equipe">
        <input class="btn btn-success" type="submit" value="save">
    </form>

    <h2>Liste des joueurs de l'equipe</h2>
    @forelse ($player as $players)
        <div>
            <p>Nom du joueur : {{ $players->nom }} {{ $players->prenom }} [ {{ $players->tel }} ] mail :
                {{ $players->email }}</p>
        </div>
    @empty
        <div class="alert alert-secondary" role="alert">
            Désolé, il n'y a pas de joueurs !
        </div>
    @endforelse
@endsection
