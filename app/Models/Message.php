<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'facture_id',
        'message',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime'
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function facture(): BelongsTo
    {
        return $this->belongsTo(Facture::class);
    }
}
