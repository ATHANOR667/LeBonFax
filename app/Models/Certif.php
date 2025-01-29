<?php

namespace App\Models;

use Composer\Package\Package;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certif extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'image',
        'categorie',
    ] ;

    public function commandes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Payment::class);
    }

    public function package (): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Pack::class,'certif_pack','pack_id','certif_id');
    }
}
