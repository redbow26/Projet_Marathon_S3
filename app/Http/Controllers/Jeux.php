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
        $nbJoueurs = $request->query('nombre_joueurs', null) !== null ?
            explode(",", str_replace("+", " ", $request->query('nombre_joueurs')))
            : null;
        $duree = $request->query('duree', null) !== null ?
            explode(",", str_replace("+", " ", $request->query('duree')))
            : null;
        $langue = $request->query('langue', null) !== null ?
            explode(",", str_replace("+", " ", $request->query('langue')))
            : null;

        $jeuxEdi = [];
        $jeuxTh = [];
        $jeuxMe = [];
        $jeuxNb = [];
        $jeuxDu = [];
        $jeuxLa = [];

        if($editeurs !== null) {
            foreach ($editeurs as $e) {
                $editeur = Editeur::where("nom", "LIKE", "%".trim($e)."%")->get();
                foreach ($editeur->jeux as $jeu)
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

        if($nbJoueurs !== null) {
            foreach ($nbJoueurs as $nb) {
                $jeu = Jeu::where("nombre_joueurs", ">=", $nb)->get();
                foreach ($jeu as $j)
                    $jeuxNb[] = $j;
            }
            $jeuxNb = array_unique($jeuxNb);
        }

        if($duree !== null) {
            foreach ($duree as $du) {
                $jeu = Jeu::where("duree", "=", $du)->get();
                foreach ($jeu as $j)
                    $jeuxDu[] = $j;
            }
            $jeuxDu = array_unique($jeuxDu);
        }

        if($langue !== null && $langue[0] !== "null") {
            foreach ($langue as $la) {
                $jeu = Jeu::where("langue", "=", $la)->get();
                foreach ($jeu as $j)
                    $jeuxLa[] = $j;
            }
            $jeuxLa = array_unique($jeuxLa);
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

        if ($nbJoueurs !== null) {
            $jeux = $this->fusion($jeux, $jeuxNb);
        }

        if ($duree !== null) {
            $jeux = $this->fusion($jeux, $jeuxDu);
        }

        if ($langue !== null && $langue[0] !== "null") {
            $jeux = $this->fusion($jeux, $jeuxLa);
        }

        $jeux = collect($jeux);

        if($sort !== null){
            if ($sort == "asc") {
                $jeux = $jeux->sortBy("nom");
            }
            else {
                $jeux = Jeu::all()->sortByDesc('nom');
            }
        }

        return view('liste-jeux', ['jeux' => $jeux, 'sort' => $sort, "editeurs" => $request->query("editeurs"),
            "themes" => $request->query("themes"), "mecaniques" => $request->query('mecaniques'),
            "nbJoueurs" => $request->query('nombre_joueurs', null),
            "duree" => $request->query('duree', null),
            "langue" => $request->query('langue', null)]);
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

        $jeux_classement = Jeu::all();
        $nbCom_jeux=[];
        foreach ($jeux_classement as $jc)
            $nbCom_jeux[$jc -> id]=count($jc -> commentaires);
        arsort($nbCom_jeux);



        $index2 = 0;
        foreach($nbCom_jeux as $nbCom_jeu) {
            $index2++;
            if ($nbCom_jeu == count($jeu -> commentaires)) {
                break;
            }
        }



        $jeu->classement= $index+1;
        $jeu ->classement_com = $index2;


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
