@extends('layout.navbar')
@section('content')
    <h1>Ajouter un professeur</h1>
    <form action="{{ route('equipe.store') }}" method="post">
        @csrf
        <input type="text" name="ville" id="" placeholder="Ville de l'equipe">
        <input type="text" name="categorie" id=""
            placeholder="Categorie de l'equipe">
        <input type="text" name="championnat" id=""
            placeholder="championnat de l'equipe">
        <input class="btn btn-success" type="submit" value="save">
    </form>
@endsection
