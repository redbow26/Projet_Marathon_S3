
@section('title', 'Liste des jeux')

    <h1 class="text-center">Tous les jeux de medusatheque</h1>
    <div class="row">
        <div class="col-6 text-left">
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

                    <h2>Créer un jeux: </h2>
                    <form action="{{route('jeux.store')}}" method="POST">
                        {!! csrf_field() !!}
                        <div>
                            <label for="nom">Nom :</label>
                            <input type="text" id="nom" name="nom" value="{{ old('nom') }}">
                        </div>

                        <div>
                            <label for="description">Description:</label>
                            <input type="text" id="description" name="description" value="{{ old('description') }}">
                        </div>

                        <div>
                            <label for="theme">Thème:</label>
                            <input type="text" id="theme" name="theme" value="{{ old('theme') }}">
                        </div>

                        <div>
                            <label for="editeur">Editeur:</label>
                            <input type="text" id="editeur" name="editeur" value=""{{ old('editeur') }}">
                        </div>
                        <div class="button">
                            <button type="submit">Créer le jeux</button>
                        </div>
                    </form>
                </div>
            @endauth
        </div>
        <div class="col-6 text-right">
            @if($sort !== 'asc')
            <a href="{{ URL::route('jeux.index', ['sort' => 'asc', "editeurs" => $editeurs, "themes" => $themes, "mecaniques" => $mecaniques]) }}">Trié par nom croissant</a>
            @endif
            @if($sort !== 'desc')
                    <a href="{{ URL::route('jeux.index', ['sort' => 'desc',  "editeurs" => $editeurs, "themes" => $themes, "mecaniques" => $mecaniques]) }}">Trié par nom decroissant</a>
            @endif

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

                    <h2>Créer un jeux: </h2>
                    <form action="{{route('jeux.index')}}" method="GET">
                        <div>
                            <label for="editeurs">Editeurs (separer les editeurs avec des ","):</label>
                            <input type="text" id="editeurs" name="editeurs" value="{{ old('editeurs') }}">
                        </div>

                        <div>
                            <label for="themes">Thèmes (separer les thèmes avec des ","):</label>
                            <input type="text" id="themes" name="themes" value="{{ old('themes') }}">
                        </div>

                        <div>
                            <label for="mecaniques">Mécaniques (separer les mécaniques avec des ","):</label>
                            <input type="text" id="mecaniques" name="mecaniques" value="{{ old('mecaniques') }}">
                        </div>

                        <div class="button">
                            <button type="submit">Rechercher</button>
                        </div>
                    </form>
                </div>

        </div>
    </div>
    <div class="row ">

        @foreach ($jeux as $jeu)
            <div class="col-4">
                <div class="card">
                    <img src="{{$jeu->url_media}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $jeu->nom }}</h5>
                        <p class="card-text">
                            {{ \Illuminate\Support\Str::limit($jeu->description, 50, $end='...') }}<br/>
                        <hr>
                        <span>{{ $jeu->theme->nom }}</span>
                        <hr>
                        <span>durée : {{ $jeu->duree }}</span>
                        <hr>
                        <span>Nombre de joueur : {{ $jeu->nombre_joueurs }}</span>
                        <hr>
                        <a href="{{ URL::route('jeux.show', $jeu->id) }}" class="btn btn-primary">Plus d'info</a>
                    </div>
                </div>
            </div>
        @endforeach

