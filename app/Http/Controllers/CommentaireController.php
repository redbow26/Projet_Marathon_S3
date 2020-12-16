<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    public function ajout(Request $request)
    {
        $this->validate(
            $request,
            [
                'commentaire' => 'required',
                'note'  => 'required',
            ]
        );

        $com = new Commentaire();

        $com->commentaire = $request->commentaire;
        $com->note = $request->note;
        $com->user_id = Auth::user()->id;
        $com->jeu_id = $request->jeu_id;
        $com->date_com = new \Datetime('now');

        $com->save();
        return redirect()->route('jeux.show', $request->jeu_id);
    }

}
