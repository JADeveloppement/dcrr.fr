<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataModeleReference extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'data_modele_reference';


    protected $fillable = [
        'id',
        'modele_reference',
        'srvDelete',
    ];
}
