@extends('layout.navbar')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Equipe</th>
                <th scope="col">Nb. Membre</th>
                <th scope="col">Victoires</th>
                <th scope="col">Nul</th>
                <th scope="col">Défaites</th>
                <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($equipe as $equipes)
                <tr>
                    <th scope="row">{{ $equipes->ville }}</th>
                    <td>{{ $playerCounts[$equipes->id] }}</td>
                    <td>
                        {{ $victoires[$equipes->id] }}
                    </td>
                    <td>{{ $nul[$equipes->id] }}</td>
                    <td>{{ $defaites[$equipes->id] }}</td>
                    <td>

                        <form method="POST" action="{{ route('equipe.destroy', ['equipe' => $equipes->id]) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <div class="form-group">
                                <input type="submit" class="btn btn-danger delete-user" value="Supprimer">
                                <a class="btn btn-secondary" href="{{ route('equipe.edit', ['equipe' => $equipes->id]) }}">Edit</a>
                            </div>
                        </form>

                    </td>
                </tr>
            @empty

                <div class="alert alert-secondary" role="alert">
                    Ha, Flut il n'y a pas d'équipe !
                </div>
            @endforelse

        </tbody>
    </table>

    <a class="btn btn-success" href="{{ route('equipe.create', ['equipe' => $equipes->id]) }}">Ajouter une nouvelle equipe</a>
@endsection
