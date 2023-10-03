<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataModeleDesignation extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'data_modele_designation';


    protected $fillable = [
        'id',
        'modele_designation',
        'srvDelete',
    ];
}
