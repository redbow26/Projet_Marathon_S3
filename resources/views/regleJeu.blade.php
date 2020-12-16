<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Règle du jeu</title>
</head>
<body>
    <h1>Les différentes règles des jeux</h1>
    @foreach($jeux as $jeu)
        <li>
            <p>ID du jeu : {{$jeu -> id}}</p>
            <p>Nom du jeu : {{$jeu -> nom}}</p>
            <p>Regle du jeu : {{$jeu -> regles}}</p>
            <div></div>
            <a href="{{route('jeux.show',['jeux'=>$jeu -> id])}}" ><button>Retourner à la page du jeu</button></a>
            <a href="../jeux"><button>Retourner à la liste de tous les jeux</button></a>
        </li>
    @endforeach
</body>
</html>
