<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'status',
        'devise',
        'montant',
        'token',
        'transaction_id',
        'dateDisponibilite',
        'motif',
        'methode',
        'pack_id',
        'certif_id',
    ];

    protected $casts = [
        'dateDisponibilite' => 'datetime',
    ];

    public function pack(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pack::class);
    }

    public function certif(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Certif::class);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeFormat(): array
    {
        return [
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'devise' => $this->devise,
            'montant' => $this->montant,
            'transaction_id' => $this->transaction_id,

        ];
    }
}
