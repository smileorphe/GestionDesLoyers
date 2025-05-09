<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Charge;
use App\Models\Transaction;

class Loyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom_locataire',
        'adresse_bien',
        'montant_loyer',
        'date_debut',
        'date_fin',
        'statut',
        'notes'
    ];

    protected $dates = [
        'date_debut',
        'date_fin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function charges()
    {
        return $this->hasMany(Charge::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function scopeActif($query)
    {
        return $query->where('statut', 'actif');
    }
}
