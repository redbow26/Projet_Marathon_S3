<?php

namespace Database\Factories;

use App\Models\Editeur;
use App\Models\Jeu;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JeuFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jeu::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $theme_ids = Theme::all()->pluck('id');
        $editeurs_ids = Editeur::all()->pluck('id');
        $user_ids = User::all()->pluck('id');
        return [
            'nom' => $this->faker->words(2, true),
            'description' => $this->faker->text(300),
            'regles' => $this->faker->text(300),
            'user_id' => $this->faker->randomElement($user_ids),
            'theme_id' => $this->faker->randomElement($theme_ids),
            'editeur_id' => $this->faker->randomElement($editeurs_ids),
        ];
    }
}
