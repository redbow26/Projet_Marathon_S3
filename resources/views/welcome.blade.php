<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/welcome.css')}}">
</head>
<body>


    <div class="texteMilieu">
       <h1> LA MEDUSATHEQUE</h1>
    </div>
    <img id="page-profile" src="{{asset('images/photo-profil.jpg')}}" alt="ma photo de profil">



@auth
    <a href="{{Route('randomGames',5)}}"><button class="button"> Nous vous proposons 5 jeux </br> aléatoire du moment </button></a>

@endauth

</body>
</html>
