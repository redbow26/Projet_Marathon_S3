<html lang="fr">
<body>
<h1 style="align-items: center"> Collection de jeu </h1>
<p> <strong> Votre liste d'achats </strong>
    @foreach(Auth::user()->ludo_perso as $jeu)
        <p> {{$jeux->nom}} </p>
    @endforeach
</p>

</body>
</html>
