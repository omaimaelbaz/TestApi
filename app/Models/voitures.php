<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voitures extends Model
{
    use HasFactory;
    protected $fillable=[
        'marque',
        'modele',
        'annee',
        'kilometrage',
        'prix',
        'puissance',
        'motorisation',
        'carburant',
        'options'

    ];
}
