<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Liste des Jeux</title>
    </head>
    <body>
        <div>
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
