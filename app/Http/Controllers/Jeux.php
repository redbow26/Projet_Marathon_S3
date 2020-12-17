<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Editeur;
use App\Models\Jeu;
use App\Models\Mecanique;
use App\Models\Theme;
use Illuminate\Http\Request;
use App\Models\User;

class Jeux extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param null $sort
     * @return \Illuminate\Http\Response
     */
    private function fusion($tab1, $tab2) {
        $temp = [];
        for ($i = 0; $i < count($tab2); $i++)
            $tab2[$i] = $tab2[$i]->id;

        foreach($tab1 as $t) {
            if (in_array($t->id, $tab2))
                $temp[] = $t;
        }
        return $temp;
    }

    public function index(Request $request)
    {
        $sort = $request->query('sort', null);
        $editeurs = $request->query('editeurs', null) !== null ?
            explode(",", str_replace("+", " ", $request->query('editeurs')))
            : null;
        $themes = $request->query('themes', null) !== null ?
            explode(",", str_replace("+", " ", $request->query('themes')))
            : null;
        $mecaniques = $request->query('mecaniques', null) !== null ?
            explode(",", str_replace("+", " ", $request->query('mecaniques')))
            : null;

        $jeuxEdi = [];
        $jeuxTh = [];
        $jeuxMe = [];

        if($editeurs !== null) {
            foreach ($editeurs as $e) {
                $editeur = Editeur::where("nom", "LIKE", "%".trim($e)."%")->get();
                foreach ($editeur->pluck('id') as $id)
                    foreach (Jeu::where("editeur_id", $id)->get() as $jeu)
                        $jeuxEdi[] = $jeu;
            }
        }
        if($themes !== null) {
            foreach ($themes as $t) {
                $theme = Theme::where("nom", "LIKE", "%".trim($t)."%")->get();
                foreach ($theme as $th)
                    foreach ($th->jeux as $jeu)
                        $jeuxTh[] = $jeu;
            }

        }
        if($mecaniques !== null) {
            foreach ($mecaniques as $m) {
                $mecanique = Mecanique::where("nom", "LIKE", "%".trim($m)."%")->get()[0];
                foreach ($mecanique->jeux as $jeu)
                    $jeuxMe[] = $jeu;
            }
            $jeuxMe = array_unique($jeuxMe);
        }

        if ($editeurs == null && $themes == null && $mecaniques == null)
            $jeux = Jeu::all();
        else if ($editeurs == null && $themes == null && $mecaniques !== null)
            $jeux = $jeuxMe;
        else if ($editeurs == null && $themes !== null && $mecaniques == null)
            $jeux = $jeuxTh;
        else if ($editeurs == null && $themes !== null && $mecaniques !== null)
            $jeux = $this->fusion($jeuxTh, $jeuxMe);
        else if ($editeurs !== null && $themes == null && $mecaniques == null)
            $jeux = $jeuxEdi;
        else if ($editeurs !== null && $themes == null && $mecaniques !== null)
            $jeux = $this->fusion($jeuxEdi, $jeuxMe);
        else if ($editeurs !== null && $themes !== null && $mecaniques == null)
            $jeux = $this->fusion($jeuxEdi, $jeuxTh);
        else if ($editeurs !== null && $themes !== null && $mecaniques !== null)
            $jeux = $this->fusion($jeuxEdi, $this->fusion($jeuxTh, $jeuxMe));

        $jeux = collect($jeux);

        if($sort !== null){
            if ($sort == "asc") {
                $jeux = $jeux->sortBy("nom");
            }
            else {
                $jeux = Jeu::all()->sortByDesc('nom');
            }
        }

        return view('liste-jeux', ['jeux' => $jeux, 'sort' => $sort, "editeurs" => $request->query("editeurs"), "themes" => $request->query("themes"), "mecaniques" => $request->query('mecaniques')]);
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
    public function show(Request $request, $id)
    {
        $sort = $request->query('sort', null);
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


        return view('info-jeu', ['jeu' => $jeu, 'jeux' => $jeux, 'sort'=> $sort, 'userT' => User::count()]);

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
