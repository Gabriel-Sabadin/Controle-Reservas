<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';

    protected $fillable = [
        'finalidade',
        'data',
        'horario_inicio',
        'horario_termino',
        'local',
        'id_user',
        'user',
        'observacao',
        'dia_reserva',
        'mes_reserva',
        'ano_reserva',
    ];


    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}