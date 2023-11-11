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
        'type',
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
        'annee',
        'modele_parent',
        'user_parent',
        'site_parent',
        'chapitre',
        'diametre_nominal',
        'categorie_de_risque',
        'periodicite_inspection',
        'pmax_hp',
        'pmin_hp',
        'pmax_mp',
        'pmin_mp',
        'pmax_bp',
        'pmin_bp',
        'tmax_hp',
        'tmin_hp',
        'tmax_mp',
        'tmin_mp',
        'tmax_bp',
        'tmin_bp',
        'annee_mes',
        'fluide_frigorigene',
        'designation_client',
        'periodicite_ip',
        'periodicite_rq',
        'date_vi'
    ];

    public function siteParent(){
        return $this->hasOne(ListeSites::class, "site_parent");
    }

    public function userParent(){
        return $this->hasOne(User::class, "user_parent");
    }

    public function data_nature(){
        return $this->belongsTo(DataModeleNature::class, "nature");
    }

    public function data_type(){
        return $this->belongsTo(DataModeleType::class, "type");
    }

    public function data_designation(){
        return $this->belongsTo(DataModeleDesignation::class, "designation");
    }

    public function data_fabricant(){
        return $this->belongsTo(DataModeleFabricant::class, "fabricant");
    }

    public function data_reference(){
        return $this->belongsTo(DataModeleReference::class, "complement_reference");
    }
}
