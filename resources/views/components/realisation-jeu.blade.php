<div>
    @if($game->url_media)
    <p>Photo: <img src="{{$user->url_media}}" alt="{{$user->url_media}}"></p>
    @endif
    <p>Nom: {{$game->nom}}</p>
    <p>Editeur: {{$game->editeur->nom}}</p>
    <p>theme: {{$game->theme->nom}}</p>
        @foreach ($game->mecaniques as $mecanique)
            <span class="tag">{{$mecanique->nom}}</span>
        @endforeach
</div>
