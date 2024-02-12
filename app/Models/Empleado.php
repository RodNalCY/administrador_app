<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleado';
    protected $primaryKey = 'idEmpleado'; 
    protected $guarded = ['idEmpleado'];
    protected $fillable = [
        'Nombres', 
        'Apellidos', 
        'Especialidad', 
        'Sexo', 
        'Dni', 
        'Email',
        'Telefono', 
        'Direccion',
        'HoraIngreso',
        'HoraSalida',
        'Sueldo',
        'Estado', 
        'idUsuario ', 
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
