<?php

namespace App\Http\Controllers;

use App\Models\Jeu;

class Jeux extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sort = null)
    {
        $filter = null;
        if($sort !== null){
            if($sort){
                $jeux = Jeu::all()->sortBy('nom');
            } else{
                $jeux = Jeu::all()->sortByDesc('nom');
            }
            $sort = !$sort;
            $filter = true;
        } else{
            $jeux = Jeu::all();
            $sort = true;
        }
        return view('liste-jeux', ['jeux' => $jeux, 'sort' => intval($sort), 'filter' => $filter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Chercher l'intégralité des thèmes et afficher le formulaire dans une nouvelle view
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nom' => 'required',
                'description'  => 'required',
                'theme' => 'required',
                'editeur' => 'required',
            ]
        );

        $jeu = new Jeu;

        $jeu->nom = $request->nom;
        $jeu->description = $request->description;
        $jeu->theme = $request->theme;
        $jeu->editeur = $request->editeur;

        $jeu->save();
        return redirect()->route('jeux.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('info-jeu', ['jeu' => Jeu::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function randomGames($nb){
        $jeux=[];

        while (count($jeux)!=$nb){
            $id_last=Jeu::all()->last()->id;
            $id=rand(1,$id_last);
            $jeu=Jeu::find($id);
            if (isset($jeu) && !in_array($jeu,$jeux))
                $jeux[]=$jeu;
        }
        return view('jeuxAleatoire',['data'=>$jeux]);
    }
}
