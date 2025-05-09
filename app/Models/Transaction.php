<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Loyer;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'loyer_id',
        'montant',
        'date_paiement',
        'type_paiement',
        'statut',
        'commentaire'
    ];

    protected $dates = [
        'date_paiement'
    ];

    public function loyer()
    {
        return $this->belongsTo(Loyer::class);
    }

    public function scopePaye($query)
    {
        return $query->where('statut', 'paye');
    }

    public function scopeEnRetard($query)
    {
        return $query->where('statut', 'en_retard');
    }
}
