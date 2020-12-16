<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Jeu;
use Illuminate\Support\Facades\DB;

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
        $jeu=Jeu::find($id);
        $jeu->moyenne = $this->moyenneNotes($id);


        $jeux=Jeu::where('theme_id',$jeu -> theme_id) -> get();
        foreach ($jeux as $j)
            $j -> moyenne = $this -> moyenneNotes($j -> id);
        $jeux =$jeux ->sortBy([['moyenne','desc']])->toArray();


        $index = 0;
        for ($i = 0;$i<count($jeux);$i++){
            if ($jeux[$i] ["id"]== $jeu -> id){
                $index = $i;
                break;
            }
        }

        $jeu->classement= $index+1;


        return view('info-jeu', ['jeu' => $jeu, 'jeux' => $jeux]);
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

    public function moyenneNotes($id){
        $jeu=Jeu::find($id);
        $notes= $jeu -> commentaires ->pluck('note');
        if (count($notes->toArray()) != 0)
            $jeu -> moyenne=round(array_sum($notes->toArray())/count($notes->toArray()),PHP_ROUND_HALF_UP);
        else
            $jeu -> moyenne = 0;
        return $jeu->moyenne;
    }
}
