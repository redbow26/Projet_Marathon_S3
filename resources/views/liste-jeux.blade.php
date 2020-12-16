
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
            <a href="{{ URL::route('jeux.index', $sort) }}">Trié par nom @if ($filter !== null)<i class="fas  @if ($sort == 0)fa-sort-down @else fa-sort-up @endif "></i> @endif</a>
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

