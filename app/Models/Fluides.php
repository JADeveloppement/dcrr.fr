<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ListeSites;

class Fluides extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'liste_fluides';


    protected $fillable = [
        'id',
        'fluide',
        'classe_securite',
        'categorie',
        'toxique'
    ];

    public function site()
    {
        return $this->hasOne(ListeSites::class, 'fluide_frigorigène');
    }
}
