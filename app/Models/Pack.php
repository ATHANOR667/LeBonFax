<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pack extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'nom',
        'prix',
        'description',
        'image',
        'reduction',
    ] ;

    public function certifs(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Certif::class,'certif_pack','pack_id','certif_id');
    }


    public function calculerPrix(): float
    {
        $prixCertifs = $this->certifs->sum('prix');

        $montantReduction = ($this->reduction / 100) * $prixCertifs;

        $prixFinal = $prixCertifs - $montantReduction;

        return max($prixFinal, 0);
    }

    public function commandes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeFormat(): array
    {
        return [
            'nom' => $this->nom,
            'description' => $this->description,
            'prix' => $this->prix,
            'reduction' => $this->reduction,
            'image' => $this->image,
            'certifs' => $this->certifs->map(function ($certif) {
                return $certif->format();
            }),
        ];
    }




}
