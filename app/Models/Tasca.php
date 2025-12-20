<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tasca extends Model
{
    use HasFactory;

    protected $table = 'tasques';

    protected $fillable = [
        'titol',
        'descripcio',
        'usuari_id',
        'prioritat_id',
        'estat_id',
        'data_finalitzacio', // <-- Afegir aquí perquè pugui ser assignat
    ];

    // Casts per assegurar que les dates són Carbon
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'data_finalitzacio' => 'date',
    ];

    public function usuari()
    {
        return $this->belongsTo(User::class);
    }

    public function prioritat() {
        return $this->belongsTo(Prioritat::class, 'prioritat_id');
    }

    public function estat()
    {
        return $this->belongsTo(Estat::class);
    }
}
