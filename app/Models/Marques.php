<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ListeSites;

class Marques extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'liste_marques';

    protected $fillable = [
        'id',
        'marque'
    ];

    public function site(){
        return $this->hasOne(ListeSites::class, "marquename");
    }
}
