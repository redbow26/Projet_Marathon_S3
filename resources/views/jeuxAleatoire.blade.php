@extends('layouts.navBar')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/jeuxAleatoire.css')}}">
@endsection

@section('content')

    <div id="contain">
        <h1>Les jeux random</h1>
        <div id="a">
            @foreach($data as $jeu)
                <p>{{$jeu->url_media}}</p>
                <p>Titre : {{$jeu->nom}}</p>
                <p>Description : {{$jeu->description}}</p>
                <p>Âge : {{$jeu->age}}</p>
                <p>Durée : {{$jeu -> duree}}</p>
                <br>
            @endforeach
        </div>
        <div id="but"><a href="{{Route('randomGames',5)}}"><button> 5 jeux aléatoire </button></a></div>
    </div>
@endsection






