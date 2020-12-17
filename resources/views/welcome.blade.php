@extends('layouts.navBar')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/welcome.css')}}">
@endsection

@section('content')

    <div class="texteMilieu">
        <h1> LA MEDUSATHEQUE</h1>
    </div>
    <img id="page-profile" src="{{asset('images/photo-profil.jpg')}}" alt="ma photo de profil">


@auth
    <a href="{{Route('randomGames',5)}}"><button> 5 jeux aléatoire </button></a>
    <a href="{{Route('bestGames',5)}}"><button> 5 meilleurs jeux </button></a>

    @endauth


@endsection
