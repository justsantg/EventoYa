<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    // Nombre explícito de la tabla (por si Laravel intenta inferir mal el nombre)
    protected $table = 'eventos';

    // Lista de campos que se pueden llenar de forma masiva
    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha',
        'hora',
        'ubicacion',
        'aprobado',
        'organizador_id', // opcional
    ];
    

    // Relación con el modelo User (opcional)
    public function organizador()
    {
        return $this->belongsTo(\App\Models\User::class, 'organizador_id');
    }
}
