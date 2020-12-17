@extends('layouts.navBar')

@section('content')

<h1 style="align-items: center"> Collection de jeu </h1>
<p> <strong> Votre liste d'achats </strong>
    @foreach(Auth::user()->ludo_perso as $jeu)
        <p> {{$jeu->nom}} </p>
    @endforeach
</p>

@endsection
