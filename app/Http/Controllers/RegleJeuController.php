<?php

namespace App\Http\Controllers;

use App\Models\Jeu;
use Illuminate\Http\Request;

class RegleJeuController extends Controller
{
    function index(){
        return view('regleJeu', ['jeux' => Jeu::all()]);
    }

    public function show($id) {
        return view('regleShow', ['jeux' => Jeu::find($id)]);
    }
}
