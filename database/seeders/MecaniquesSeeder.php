<?php

namespace Database\Seeders;

use App\Models\Mecanique;
use Illuminate\Database\Seeder;

class MecaniquesSeeder extends Seeder {
    const mecaniques = [
        'Abstrait',
        'Humour',
        'Jeu de plateau',
        'Enquêtes & Mystères',
        'Antiquité',
        'Western',
        'Jeu de Cartes',
        'Connaissances',
        'jeu de tuiles',
        'Lettres',
        'Politique',
        'Dessin',
        'Mime',
        'Zombies',
        'Contes',
        'Observation',
        'Bande dessinée',
        'Animaux',
        'Affrontement',
        'Commerce',
        'Jeu de rôle',
        'Chance & Hasard',
        'Cuisine',
        'Bourse & finances',
        'Divers',
        'Histoire',
        'choix multiples',
        'Jeu d\'Ambiance',
        'Chiffres',
        'Lettres & chiffres'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        for($i = 0; $i < count(self::mecaniques); $i++){
            $mecanique = new Mecanique();
            $mecanique->nom = self::mecaniques[$i];
            $mecanique->save();
        }
    }
}
