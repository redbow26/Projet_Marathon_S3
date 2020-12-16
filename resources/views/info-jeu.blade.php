<html lang="fr">
    <body>
        <h1 style="align-items: center"> Détails du jeu </h1>

        <div class="container">
            <div class="row">
                <div class="col">
                    {{$note = 0}}
                    @foreach($jeu -> $commentaires as $commentaire)
                        {{$note += $commentaire->note}}
                    @endforeach
                    {{$moyenne = $note/\count($jeu->commentaires)}}
                </div>
                <div class="col">
                    {{$jeu->commentaires->max()->note}}
                </div>
                <div class="col">
                    {{$jeu->commentaires->min()->note}}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    {{count($jeu->commentaires)}}
                </div>
                <div class="col">
                    {{\App\Models\Commentaire::all()->count()}}
                </div>
                <div class="col">
                    3 of 3
                </div>
            </div>
        </div>



        <ul>
            <li>
                <p>  {{$jeu -> url_media}} </p>
                <p> <strong> Titre du jeux </strong>: {{$jeu -> nom}} </p>
                <p> <strong> La (les) mécanique(s) </strong>
                @foreach($jeu -> mecaniques as $mecanique)
                    {{$mecanique->nom}}
                    @endforeach
                </p>
                <p> <strong> Descriptions </strong>: {{$jeu -> nom}} </p>
                <p> <strong> Thème </strong>: {{$jeu -> theme -> theme}} </p>
                <p> <strong> Catégorie </strong>: {{$jeu -> categorie}} </p>
                <p> <strong> Langue </strong>: {{$jeu -> langue}} </p>
                <p> <strong> Éditeur </strong>: {{$jeu -> editeur -> nom}} </p>
                <p> <strong> Nombre de joueurs </strong>: {{$jeu -> nombre_joueurs}} </p>
                <p> <strong> Durée </strong>: {{$jeu -> duree}} </p>
            </li>
        </ul>

        <a href="{{route('regle.show', ['id' => $jeu->id])}}"><button>Voir les regles</button></a>
        <a href="{{route('jeux.index')}}"><button>Retour a la liste</button></a>

    </body>
</html>
