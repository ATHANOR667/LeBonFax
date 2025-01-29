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



}
