<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mecanique extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['nom'];

    function jeux() {
        return $this->belongsToMany(Jeu::class, 'avec_mecaniques');
    }
}
