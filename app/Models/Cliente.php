<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';
    protected $guarded = ['idCliente'];
    protected $fillable = [
        'Nombres', 
        'Apellidos', 
        'Sexo', 
        'Dni', 
        'Telefono', 
        'Ruc',
        'Email', 
        'Direccion', 
    ];

}
