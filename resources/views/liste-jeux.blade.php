<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Liste des Jeux</title>
    </head>
    <body>
        <div>
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
                </form>

                <div class="button">
                    <button type="submit">Créer le jeux</button>
                </div>
            </div>


            <h1 style="text-align:center">Liste des Jeux</h1>
            <br>
            @foreach ($jeux as $i)
                <li>
                    <p>
                        Nom :
                        @if($i -> nom != null)
                            {{$i -> nom}}
                        @else
                            PAS DE DONNEE
                        @endif
                    </p>
                    <p>
                        Thème :
                        @if($i -> theme -> nom != null)
                            {{$i -> theme -> nom}}
                        @else
                            PAS DE DONNEE
                        @endif
                    </p>
                    <p>
                        Durée d'une partie :
                        @if($i -> duree != null)
                            {{$i -> duree}}
                        @else
                            PAS DE DONNEE
                        @endif
                    </p>
                    <p>
                        Nombre de joueurs :
                        @if($i-> nombre_joueurs != null)
                            {{$i-> nombre_joueurs}}
                        @else
                            PAS DE DONNEE
                        @endif
                        </p>
                </li>
                <a href="{{route('jeux.show',['jeux'=>$i -> id])}}"><button>+</button></a>
            <br>
            @endforeach
        </div>
    </body>
</html>
