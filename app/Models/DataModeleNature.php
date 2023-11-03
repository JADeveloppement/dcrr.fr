<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ListeSite;

class DataModeleNature extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'data_modele_nature';


    protected $fillable = [
        'id',
        'modele_nature',
        'srvDelete',
    ];

    public function data_nature(){
        return $this->belongsTo(ListeSites::class, "nature");
    }
}
