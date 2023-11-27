<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    use HasFactory;

    protected $table = 'laboratorio';
    protected $guarded = ['idLaboratorio'];
    protected $fillable = [
        'Nombre', 
        'Direccion', 
        'Telefono', 
        'Estado', 
    ];

}
