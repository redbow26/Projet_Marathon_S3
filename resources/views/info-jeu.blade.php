<html lang="fr">
    <body>
        <h1 style="align-items: center"> Détails du jeu </h1>

        <p>  {{$jeu->url_media}} </p>

        <p> <strong> Titre du jeux </strong>: {{$jeu->nom}} </p>
        <p> <strong> La (les) mécanique(s) </strong></p>
        @foreach($jeu->mecaniques as $mecanique )
        <p>{{$mecanique->nom}}</p>
        @endforeach
        <p> <strong> Descriptions </strong>: {{$jeu -> nom}} </p>
        <p> <strong> Thème </strong>: {{$jeu -> theme -> theme}} </p>
        <p> <strong> Catégorie </strong>: {{$jeu -> categorie}} </p>
        <p> <strong> Langue </strong>: {{$jeu -> langue}} </p>
        <p> <strong> Éditeur </strong>: {{$jeu -> editeur -> nom}} </p>
        <p> <strong> Nombre de joueurs </strong>: {{$jeu -> nombre_joueurs}} </p>
        <p> <strong> Durée </strong>: {{$jeu -> duree}} </p>

        <button><a href="{{route('jeux.index')}}"> Retourner à la liste des jeux </a></button>

    </body>
</html>
