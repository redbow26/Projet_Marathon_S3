<?php

namespace App\Http\Controllers;

use App\Models\Jeu;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AchatController extends Controller
{

    /**
     * @param \Illuminate\Http\Response
     * @param \Illuminate\Http\Request $request
     */
    function store(Request $request) {
        $this->validate(
            $request,
            [
            'lieu' => 'required',
            'prix' => 'required',
        ]);
        $jeux = Jeu::find($request->id);
        $jeux->acheteurs()->attach(Auth::id(),[
            'lieu'=>$request->lieu,
            'prix'=>$request->prix,
            'date_achat'=> new DateTime('now')]);
        $jeux->save();

        return redirect()->route('jeux.show', $request->id);
    }

    function destroy(Request $request) {

        $jeux = Jeu::find($request->id);
        $jeux->acheteurs()->detach(Auth::id());
        $jeux->save();

        return redirect()->route('jeux.show', $request->id);
    }
}
