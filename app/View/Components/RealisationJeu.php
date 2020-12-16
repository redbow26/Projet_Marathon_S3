<?php

namespace App\View\Components;

use App\Models\Jeu;
use Illuminate\View\Component;

class RealisationJeu extends Component
{
    public $game;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($game)
    {
        $this->game = Jeu::find($game);

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.realisation-jeu');
    }
}
