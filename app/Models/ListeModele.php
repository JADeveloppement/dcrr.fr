<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListeModele extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'listeModele';

    protected $fillable = [
        'id',
        'nature',
        'designation',
        'complement_reference',
        'fabricant',
        'volume',
        'p_max_constructeur',
        'p_min_constructeur',
        'p_test',
        'p_max_reel',
        'p_min_reel',
        't_max_constructeur',
        't_min_constructeur',
        't_max_reel',
        't_min_reel',
        'tarage',
        'date_mes',
        'categorie_fluide_frigorigene',
        'numero_de_serie',
        'modele_parent',
        'user_parent',
        'site_parent'
    ];

    public function siteParent(){
        return $this->hasOne(ListeSites::class, "site_parent");
    }

    public function userParent(){
        return $this->hasOne(User::class, "user_parent");
    }
}
