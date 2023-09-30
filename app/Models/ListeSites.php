<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListeSites extends Model
{
    use HasFactory;
    public $timestamps = false;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'proprietaire');
    }
}
