@extends('layouts.navBar')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/regle.css')}}">
@endsection

@section('content')

    <div class="fond">
        <h1><strong>La règles du jeu </strong></h1>
        <h2><strong>Nom du jeu : {{$jeux -> nom}}</strong></h2>
        <p><strong>Regle du jeu :</strong> {{$jeux -> regles}}</p>
    </div>

@endsection



