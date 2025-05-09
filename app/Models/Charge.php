<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Loyer;

class Charge extends Model
{
    use HasFactory;

    protected $fillable = [
        'loyer_id',
        'type_charge',
        'montant',
        'periode_debut',
        'periode_fin',
        'description'
    ];

    protected $dates = [
        'periode_debut',
        'periode_fin'
    ];

    public function loyer()
    {
        return $this->belongsTo(Loyer::class);
    }

    public function scopeParType($query, $type)
    {
        return $query->where('type_charge', $type);
    }
}
