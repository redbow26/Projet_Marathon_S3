<?php

namespace Database\Factories;

use App\Models\Commentaire;
use App\Models\Jeu;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentaireFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Commentaire::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $user_ids = User::all()->pluck('id');
        $jeu_ids = Jeu::all()->pluck('id');
        return [
            'commentaire' => $this->faker->text(200),
            'date_com' => $this->faker->dateTimeInInterval(
                $startDate = '-6 months',
                $interval = '+ 180 days',
                $timezone = date_default_timezone_get()
            ),
            'user_id' => $this->faker->randomElement($user_ids),
            'jeu_id' => $this->faker->randomElement($jeu_ids),
            'note' => $this->faker->numberBetween(1, 5)
        ];
    }
}
