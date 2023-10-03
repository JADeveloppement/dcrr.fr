<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\DataModeleNature;
use App\Models\DataModeleType;
use App\Models\DataModeleDesignation;

class DataModele extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'data_modele';


    protected $fillable = [
        'id',
        'type',
        'nature',
        'designation',
        'complement_reference',
        'fabricant',
        'volume',
        'diametre_nominal',
        'p_max_constructeur',
        'p_min_constructeur',
        'p_test',
        'tarage',
        't_min_constructeur',
        't_max_constructeur',
        'p_min_reel',
        'p_max_reel',
        't_min_reel',
        't_max_reel',
        'annee',
        'chapitre',
        'categorie_de_risque',
        'periodicite_inspection',
        'declaration_mes',
        'numero_de_serie'
    ];

    public function modele_nature(){
        return $this->belongsTo(DataModeleNature::class, "nature");
    }

    public function modele_type(){
        return $this->belongsTo(DataModeleType::class, "type");
    }

    public function modele_designation(){
        return $this->belongsTo(DataModeleDesignation::class, "designation");
    }
}
