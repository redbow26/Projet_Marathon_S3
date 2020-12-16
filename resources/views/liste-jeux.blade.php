<body>
    <div>
        @foreach ($jeux as $appli)
            <li>
                <p>Nom de l'application : </p>{{$appli -> nom}}
                <p>Theme de l'application : </p>{{$appli -> theme}}
            </li>
        @endforeach
    </div>
</body>
