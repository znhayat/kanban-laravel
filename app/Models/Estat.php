<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estat extends Model
{
    protected $fillable = [
        'nom',
        'color',
        'ordre',
        'per_defecte',
        'descripcio',
    ];

    protected $table = 'estats';

    
}
