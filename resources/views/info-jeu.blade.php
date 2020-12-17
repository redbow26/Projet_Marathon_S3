@extends('layouts.navBar')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/info-jeu.css')}}">
@endsection

    @section('content')
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="fond">
            <h1> Détails du jeu </h1>
            <p> {{$jeu -> url_media}}</p>
            <h2 id="titre"> Titre du jeux : {{$jeu -> nom}} </h2>
            <!-- Statistique du jeu -->
            <div class="container">
                @if(count($jeu ->commentaires) > 0)
                    <div class="row">
                        <div class="col">
                            @if ($jeu->moyenne <= 1)
                                <style type="text/css">#noteMoyenne{color:rgb(255,0,0);}</style>
                            @elseif ($jeu->moyenne <= 2)
                                <style type="text/css">#noteMoyenne{color:rgb(192,64,0);}</style>
                            @elseif ($jeu->moyenne <= 3)
                                <style type="text/css">#noteMoyenne{color:rgb(128,128,0);}</style>
                            @elseif ($jeu->moyenne <= 4)
                                <style type="text/css">#noteMoyenne{color:rgb(64,192,0);}</style>
                            @else
                                <style type="text/css">#noteMoyenne{color:rgb(0,255,0);}</style>
                            @endif
                            <p>Note :<span id="noteMoyenne">{{$jeu->moyenne}} </span>/5</p>
                        </div>
                        <div class="col">
                            @if ($jeu->commentaires->max()->note <= 1)
                                <style type="text/css">#meilleurNote{color:rgb(255,0,0);}</style>
                            @elseif ($jeu->commentaires->max()->note <= 2)
                                <style type="text/css">#meilleurNote{color:rgb(192,64,0);}</style>
                            @elseif ($jeu->commentaires->max()->note <= 3)
                                <style type="text/css">#meilleurNote{color:rgb(128,128,0);}</style>
                            @elseif ($jeu->commentaires->max()->note <= 4)
                                <style type="text/css">#meilleurNote{color:rgb(64,192,0);}</style>
                            @else
                                <style type="text/css">#meilleurNote{color:rgb(0,255,0);}</style>
                            @endif
                            <p >La meilleur note : <span id="meilleurNote">{{$jeu->commentaires->max()->note}}</span> </p>
                        </div>
                        <div class="col">
                            @if ($jeu->commentaires->min()->note <= 1)
                                <style type="text/css">#pireNote{color:rgb(255,0,0);}</style>
                            @elseif ($jeu->commentaires->min()->note <= 2)
                                <style type="text/css">#pireNote{color:rgb(192,64,0);}</style>
                            @elseif ($jeu->commentaires->min()->note <= 3)
                                <style type="text/css">#pireNote{color:rgb(128,128,0);}</style>
                            @elseif ($jeu->commentaires->min()->note <= 4)
                                <style type="text/css">#pireNote{color:rgb(64,192,0);}</style>
                            @else
                                <style type="text/css">#pireNote{color:rgb(0,255,0);}</style>
                            @endif
                            <p>La pire note : <span id="pireNote">{{$jeu->commentaires->min()->note}}</span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @if($jeu->classement_com <= 3)
                                <p>Nombre de commentaires en rapport avec ce jeu : <i class="fas fa-fire" style="color: red; font-size: 200px"></i> {{count($jeu->commentaires)}}</p>
                            @elseif($jeu -> classement >3 && $jeu -> classement <8)
                                <p>Nombre de commentaires en rapport avec ce jeu : <i class="fas fa-fire" style="color: red; font-size: 100px"></i> {{count($jeu->commentaires)}}</p>
                            @elseif($jeu -> classement > 7)
                                <p>Nombre de commentaires en rapport avec ce jeu :  <img src="public/images/flame.jpg" alt="" style="width: 50px"> {{count($jeu->commentaires)}}</p>
                            @else
                                <p>Nombre de commentaires en rapport avec ce jeu : {{count($jeu->commentaires)}} </p>
                            @endif
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
                        <input type="hidden"  name="id" value="{{$jeu->id}}">
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


                            <div class="dateA" id="acheter1">
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
                    <h3>Ajouter un commentaire :</h3>
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
                    <table>
                        @foreach ($jeu->commentaires->sortBy('date_com') as $comm)
                            <tr id="cadre">
                                <td>{{$comm->user->name}}</td>
                                <td>{{ $comm->commentaire }}</td>
                                <td>{{ $comm->note }}/5</td>
                                <td>{{ $comm->date_com }}</td>
                            </tr>
                        @endforeach
                    </table>
                @elseif ($sort == 'desc')
                    <table>
                        @foreach ($jeu->commentaires->sortByDesc('date_com') as $comm)
                            <tr id="cadre">
                                <td>{{$comm->user->name}}</td>
                                <td>{{ $comm->commentaire }}</td>
                                <td>{{ $comm->note }}/5</td>
                                <td>{{ $comm->date_com }}</td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <table>
                        @foreach ($jeu->commentaires as $comm)
                                <tr id="cadre">
                                    <td>{{$comm->user->name}}</td>
                                    <td>{{ $comm->commentaire }}</td>
                                    <td>{{ $comm->note }}/5</td>
                                    <td>{{ $comm->date_com }}</td>
                                </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>
    @endsection
