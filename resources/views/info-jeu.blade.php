<html lang="fr">
    <body>
        <h1 style="align-items: center"> Détails du jeu </h1>
        <ul>
            <li>
                <p> {{$jeu -> url_media}}</p>
                <p> <strong> Titre du jeux </strong>: {{$jeu -> nom}} </p>
                <h2>Acheter le jeu: </h2>
                {{ $found = null }}
                @foreach ($jeu->acheteurs as $achat)
                    @if($achat->id == Auth::id())
                        <?php $found = true ?>
                    @endif
                @endforeach
                @if($found == null)
                <form action="{{route('achat.store')}}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" id="id" name="id" value="{{$jeu->id}}">
                    <div>
                        <label for="date_achat">Date d'achat :</label>
                        <input type="text" id="date_achat" name="date_achat" value="{{ old('date_achat') }}">
                    </div>

                    <div>
                        <label for="lieu">Lieu :</label>
                        <input type="text" id="lieu" name="lieu" value="{{ old('lieu') }}">
                    </div>

                    <div>
                        <label for="prix">Prix :</label>
                        <input min="0" max="100" type="number" id="prix" name="prix" value=""{{ old('prix') }}">
                    </div>
                    <div class="button">
                        <button type="submit">Acheter</button>
                    </div>
                </form>
                @else
                    <form action="{{route('achat.destroy')}}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden"  name="id" value="{{$jeu->id}}">

                        <div class="button">
                            <button type="submit">Retirer de sa collection</button>
                        </div>
                    </form>
                @endif

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
