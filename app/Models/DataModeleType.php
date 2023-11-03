<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataModeleType extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'data_modele_type';


    protected $fillable = [
        'id',
        'modele_type',
        'srvDelete',
    ];
}
