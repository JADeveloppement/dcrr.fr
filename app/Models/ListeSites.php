<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Marques;
use App\Models\Fluides;

class ListeSites extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'listeSites';


    protected $fillable = [
        'id',
        'code_client',
        'nom_client',
        'nom_site',
        'code_site',
        'marque',
        'date_mise_en_service',
        'fluide_frigorigène',
        'designation_equipement',
        'conforme',
        'proprietaire',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'proprietaire');
    }

    public function fluide()
    {
        return $this->belongsTo(Fluides::class, 'fluide_frigorigène');
    }

    public function marque(){
        return $this->belongsTo(Marques::class, "marquename");
    }
}
