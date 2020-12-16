<html lang="fr">
    <body>
        <h1 style="align-items: center"> Détails du jeu </h1>

        <ul>
            <li>
                <p>  {{$info -> url_media}} </p>
                <p> <strong> Titre du jeux </strong>: {{$info -> nom}} </p>
                <p> <strong> La (les) mécanique(s) </strong>: {{$info -> mecanique -> nom}} </p>
                <p> <strong> Descriptions </strong>: {{$info -> nom}} </p>
                <p> <strong> Thème </strong>: {{$info -> theme -> nom}} </p>
                <p> <strong> Catégorie </strong>: {{$info -> categorie}} </p>
                <p> <strong> Langue </strong>: {{$info -> langue}} </p>
                <p> <strong> Éditeur </strong>: {{$info -> editeur -> nom}} </p>
                <p> <strong> Nombre de joueurs </strong>: {{$info -> nombre_joueurs}} </p>
                <p> <strong> Durée </strong>: {{$info -> duree}} </p>
            </li>
        </ul>

    </body>
</html>
