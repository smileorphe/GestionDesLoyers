<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facture extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'numero',
        'loyer_id',
        'user_id',
        'date_emission',
        'date_echeance',
        'montant_ht',
        'tva',
        'montant_ttc',
        'statut',
        'notes',
        'fichier_pdf'
    ];

    protected $dates = [
        'date_emission',
        'date_echeance',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'montant_ht' => 'decimal:2',
        'tva' => 'decimal:2',
        'montant_ttc' => 'decimal:2',
    ];

    public function loyer()
    {
        return $this->belongsTo(Loyer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
