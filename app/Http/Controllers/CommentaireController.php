<?php


namespace App\Http\Controllers;


use App\Models\Commentaire;

class CommentaireController
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

        $com = new Commentaire;

        $com->commentaire = $request->commentaire;
        $com->note = $request->note;

        $com->save();
    }
}
