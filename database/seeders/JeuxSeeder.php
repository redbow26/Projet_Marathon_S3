<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JeuxSeeder extends Seeder
{

    const titre = ['Death Note',
        'Cowboy Bebop',
        "L'Attaque des Titans",
        "Fullmetal Alchemist : Brotherhood",
        "Samurai Champloo",
        "Neon Genesis Evangelion ",
        "Hunter x Hunter ",
        "One Piece",
        "Code Geass: Lelouch of the Rebellion ",
        "Dragon Ball Z ("
        ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nom => $faker->name;
         app/Models/jeu::factory(10)->create();


    }
}
