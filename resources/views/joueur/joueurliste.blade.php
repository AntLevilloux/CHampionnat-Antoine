@extends('layout.navbar')
@section('content')
    <h2>Liste des joueurs de l'equipe</h2>
    @forelse ($equipe as $equipes)
    <h1>{{ $equipes->ville }}</h1>
        @forelse ($joueur as $joueurs)
            @if ($equipes->id == $joueurs->equipe_id)
                <div>
                    <p>Nom du joueur : {{ $joueurs->nom }} {{ $joueurs->prenom }} [ {{ $joueurs->tel }} ] mail :
                        {{ $joueurs->email }}</p>
                </div>

                <form method="POST" action="{{ route('joueur.destroy', ['joueur' => $joueur->id]) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <div class="form-group">
                        <input type="submit" class="btn btn-danger delete-user" value="Supprimer">
                        <a class="btn btn-secondary" href="{{ route('joueur.edit', ['joueur' => $joueur->id]) }}">Edit</a>
                    </div>
                </form>

            @endif
        @empty
            <div class="alert alert-secondary" role="alert">
                Désolé, il n'y a pas de joueurs !
            </div>
        @endforelse


    @empty
        ee
    @endforelse
    <a class="btn btn-success" href="{{ route('equipe.create') }}">Ajouter un joueur</a>
@endsection
