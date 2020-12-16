<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Règle du jeu</title>
</head>
<body>
    <h1>La règles du jeu : {{$jeux -> nom}}</h1>
    <li>
        <p>ID du jeu : {{$jeux -> id}}</p>
        <p>Nom du jeu : {{$jeux -> nom}}</p>
        <p>Regle du jeu : {{$jeux -> regles}}</p>
        <p></p>
        <a href="{{route('jeux.show', ['jeux' => $jeux -> id])}}"><button>Retourner à la page du jeu</button></a>
        <a href="../jeux"><button>Retourner à la liste de tous les jeux</button></a>
    </li>
</body>
</html>
