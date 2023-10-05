@extends('layout.navbar')
@section('content')

    <h1>Matches</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Domicile</th>
                <th scope="col">Visiteur</th>
                <th scope="col">date</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($matche as $matches)
                <tr>

                    @foreach ($equipe as $equipes)
                        @if ($matches->domicile == $equipes->id)
                            <td>{{ $equipes->ville }}</td>
                        @endif
                    @endforeach

                    @foreach ($equipe as $equipes)
                        @if ($matches->visiteur == $equipes->id)
                            <td>{{ $equipes->ville }}</td>
                        @endif
                    @endforeach
                    <td>{{ $matches->date }}</td>
                </tr>
            @empty

                <div class="alert alert-secondary" role="alert">
                    Ha, Flut il n'y a pas de matches !
                </div>
            @endforelse

        </tbody>
    </table>
    <h1>Equipes du championnats</h1>

<h1>soon</h1>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
@endsection
