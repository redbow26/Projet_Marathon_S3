<html lang="fr">
    <body>
        <h1 style="align-items: center"> Détails du jeu </h1>

        <ul>
            <li>
                <p>  {{$jeu -> url_media}} </p>
                <p> <strong> Titre du jeux </strong>: {{$jeu -> nom}} </p>
                <p> <strong> La (les) mécanique(s) </strong>: {{$jeu -> mecanique -> nom}} </p>
                <p> <strong> Descriptions </strong>: {{$jeu -> nom}} </p>
                <p> <strong> Thème </strong>: {{$jeu -> theme -> theme}} </p>
                <p> <strong> Catégorie </strong>: {{$jeu -> categorie}} </p>
                <p> <strong> Langue </strong>: {{$jeu -> langue}} </p>
                <p> <strong> Éditeur </strong>: {{$jeu -> editeur -> nom}} </p>
                <p> <strong> Nombre de joueurs </strong>: {{$jeu -> nombre_joueurs}} </p>
                <p> <strong> Durée </strong>: {{$jeu -> duree}} </p>
            </li>
        </ul>

    </body>
</html>
