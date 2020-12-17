@extends('layouts.navBar')

@section('content')
<h1>Ma super page d'accueil</h1>



@auth
    <a href="{{Route('randomGames',5)}}"><button> 5 jeux aléatoire </button></a>
    <a href="{{Route('bestGames',5)}}"><button> 5 meilleurs jeux </button></a>

@endauth

@endsection
