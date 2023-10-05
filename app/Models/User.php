<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\ListeSites;
use App\Models\DataRole;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nomprenom',
        'email',
        'password',
        'telephone',
        'entreprise',
        'poste',
        'newsletter',
        'role',
        'active',
        'createdAt'
    ];

    public function listeSites()
    {
        return $this->hasMany(ListeSites::class, 'proprietaire');
    }

    public function data_role(){
        return $this->belongsTo(DataRole::class, "role");
    }
}
