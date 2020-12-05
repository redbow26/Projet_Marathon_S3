<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemesSeeder extends Seeder
{
    const themes = ['Abstrait, lettres & mots',
        'Animaux & Nature',
        'Autres',
        'Cartoon & Dessin',
        'Enfance & Contes',
        'Fantastique & Héroïc Fantasy',
        'Histoire & Antiquité',
        'Horreur & Post-Apocalytique',
        'Loisirs & Voyage',
        'Moderne & Réaliste',
        'Pirates & Cow-boys',
        'Science Fiction & Future',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < count(self::themes); $i++){
            $theme = new Theme();
            $theme->nom = self::themes[$i];
            $theme->save();
        }
    }
}
