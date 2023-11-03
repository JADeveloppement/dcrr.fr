<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataModeleFabricant extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'data_modele_fabricant';


    protected $fillable = [
        'id',
        'modele_fabricant',
        'srvDelete',
    ];
}
