<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{asset('css/info-jeu.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Détails du jeu</title>
</head>
    <body>@extends('layouts.navBar')

    @section('content')
        <div class="fond">
            <h1> Détails du jeu </h1>
            <p> {{$jeu -> url_media}}</p>
            <h2 id="titre"> Titre du jeux : {{$jeu -> nom}} </h2>
            <!-- Statistique du jeu -->
            <div class="container">
                @if(count($jeu ->commentaires) > 0)
                    <div class="row">
                        <div class="col">
                            <p >Note : {{$jeu->moyenne}} /5</p>
                        </div>
                        <div class="col">
                            <p >La meilleur note :
                                {{$jeu->commentaires->min()->note}}</p>
                        </div>
                        <div class="col">
                            <p>La pire note : {{$jeu->commentaires->max()->note}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Nombre de commentaires en rapport avec ce jeu : {{count($jeu->commentaires)}}</p>
                        </div>
                        <div class="col">
                            <p> Nombre total de commentaires : {{\App\Models\Commentaire::all()->count()}}</p>
                        </div>
                        <div class="col">
                            <p>Ce jeu est classé : {{$jeu->classement}} / {{count($jeux)}}</p>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col">
                            <p>Pas de moyenne</p>
                        </div>
                        <div class="col">
                            <p>La meilleur note : Pas de notes</p>
                        </div>
                        <div class="col">
                            <p>La pire note : Pas de notes</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Nombre de commentaires en rapport avec ce jeu : Aucun commentaires</p>
                        </div>
                        <div class="col">
                            <p> Nombre total de commentaires : {{\App\Models\Commentaire::all()->count()}}</p>
                        </div>
                        <div class="col">
                            <p>Ce jeu est classé : {{$jeu->classement}} / {{count($jeux)}}</p>
                        </div>
                    </div>
                @endif
            </div>


    <!-- Détails du jeux -->
                    <h3>Acheter le jeu: </h3>
                    {{ $found = null }}
                    @foreach ($jeu->acheteurs as $achat)
                        @if($achat->id == Auth::id())
                            <?php $found = true ?>
                        @endif
                    @endforeach
                    @if($found == null)
                    <form action="{{route('achat.store')}}" method="POST">
                        {!! csrf_field() !!}
                        <div class="dateA">
                            <label for="lieu">Lieu :</label>
                            <input type="text" id="lieu" name="lieu" value="{{ old('lieu') }}">
                            <label for="prix">Prix :</label>
                            <input min="0" max="100" type="number" id="prix" name="prix" value=""{{ old('prix') }}">
                        </div>
                        <div class="dateA" id="acheter1">
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
            <div id="boite">
                    <p> <strong> La (les) mécanique(s) </strong>
                    @foreach($jeu -> mecaniques as $mecanique)
                        {{$mecanique->nom}}
                    @endforeach
                    </p>
                    <p> <strong> Descriptions </strong>: {{$jeu -> nom}} </p>
                    <p> <strong> Thème </strong>: {{$jeu -> theme -> nom}} </p>
                    <p> <strong> Catégorie </strong>: {{$jeu -> categorie}} </p>
                    <p> <strong> Langue </strong>: {{$jeu -> langue}} </p>
                    <p> <strong> Éditeur </strong>: {{$jeu -> editeur -> nom}} </p>
                    <p> <strong> Nombre de joueurs </strong>: {{$jeu -> nombre_joueurs}} </p>
                    <p> <strong> Durée </strong>: {{$jeu -> duree}} </p>
            </div>
            <div id="regle">
                <a href="{{route('regle.show', ['id' => $jeu->id])}}"><button>Voir les regles</button></a>
                <a href="{{route('jeux.index')}}"><button>Retour a la liste</button></a>
            </div>
            <!-- Section ajout de commentaire -->
            @auth
                <div>
                    @if ($errors->any())
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h3>Ajouter un commentaire :</h3>
                        @if ($errors->any())
                            <div>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <form action="{{route('commentaire_ajout')}}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" id="jeu_id" name="jeu_id" value="{{$jeu->id}}">

                        <div id="com">
                            <label for="commentaire">Commentaire :</label>
                            <input type="text" id="commentaire" name="commentaire" value="{{ old('commentaire') }}">
                            <label for="note">Note :</label>
                            <input min="0" max="5" type="number" id="note" name="note" value="{{ old('note') }}">
                        </div>

                        <div class="button" id="envoy">
                            <button type="submit">envoyer</button>
                        </div>
                    </form>
                </div>
            @endauth

            <h3 id="com1">Commentaires :</h3>
            <div id="trie">
                @if($sort !== 'asc')
                    <a href="{{ URL::route('jeux.show', [$jeu->id, 'sort' => 'asc']) }}"><button >Trié par date croissante</button></a>
                @endif
                @if($sort !== 'desc')
                    <a href="{{ URL::route('jeux.show', [$jeu->id, 'sort' => 'desc']) }}" class="trie"><button >Trié par date decroissante</button></a>
                @endif
            </div>
            <div id="com1">
                @if ($sort == 'asc')
                    @foreach ($jeu->commentaires->sortBy('date_com') as $comm)
                        <br>
                        <span>{{ $comm->commentaire }}</span>
                        <span>{{ $comm->note }}/5</span>
                        <span>{{ $comm->duree }}</span>
                        <span>{{ $comm->date_com }}</span>
                        <br>
                    @endforeach
                @elseif ($sort == 'desc')
                    @foreach ($jeu->commentaires->sortByDesc('date_com') as $comm)
                        <br>
                        <span>{{ $comm->commentaire }}</span>
                        <span>{{ $comm->note }}/5</span>
                        <span>{{ $comm->duree }}</span>
                        <span>{{ $comm->date_com }}</span>
                        <br>
                    @endforeach
                @else
                    @foreach ($jeu->commentaires as $comm)
                        <br>
                        <span>{{ $comm->commentaire }}</span>
                        <span>{{ $comm->note }}/5</span>
                        <span>{{ $comm->duree }}</span>
                        <br>
                    @endforeach
                @endif
            </div>
        </div>


    </body>
</html>
