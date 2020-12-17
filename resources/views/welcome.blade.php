@extends('layouts.navBar')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/welcome.css')}}">
@endsection

@section('content')
    <h1>Ma super page d'accueil</h1>

    <div class="texteMilieu">
        <h1> LA MEDUSATHEQUE</h1>
    </div>
    <img id="page-profile" src="{{asset('images/photo-profil.jpg')}}" alt="ma photo de profil">


    @auth
        <a href="{{Route('randomGames',5)}}"><button class="button"> Nous vous proposons 5 jeux aléatoire du moment</button></a>

    @endauth


@endsection
