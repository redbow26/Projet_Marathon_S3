


<a href="{{Route('randomGames',5)}}"><button> 5 jeux aléatoire </button></a>


<ul>
@foreach($data as $jeu)
        <li>{{$jeu->url_media}}</li>
        <li>Titre : {{$jeu->nom}}</li>
        <li>Description : {{$jeu->description}}</li>
        <li>Âge : {{$jeu->age}}     Durée : {{$jeu -> duree}}</li>
    <br>
@endforeach
</ul>
