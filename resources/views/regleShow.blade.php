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
    <li>
        <p>ID du jeu : {{$jeux -> id}}</p>
        <p>Nom du jeu : {{$jeux -> nom}}</p>
        <p>Regle du jeu : {{$jeux -> regles}}</p>
        <p></p>
        <a href="../enonce" >Retourner à la page du jeu</a>
        <p></p>
        <a href="../liste-jeux">Retourner à la liste de tous les jeux</a>
    </li>
</body>
</html>
