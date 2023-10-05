<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\DataModeleNature;
use App\Models\DataModeleType;
use App\Models\DataModeleDesignation;

class DataRole extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'data_role';


    protected $fillable = [
        'id',
        'value',
        'srvDelete'
    ];
}
