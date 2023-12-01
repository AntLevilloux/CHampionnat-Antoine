<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
    <body>

        <p>
            <strong>Nouveau joueur crée :</strong>
            <br>
            <br>
            Nom : {{$joueur->nom}}
            <br>
            Prenom : {{$joueur->prenom}}
            <br>
            Adresse email : {{$joueur->email}}
            <br>
            Numero de téléphone : {{$joueur->tel}}
            <br>
            L'equipe : {{$joueur->equipe_id}}
            <br>
            Le sexe : {{$joueur->sexe}}

        </p>

    </body>

</html>
