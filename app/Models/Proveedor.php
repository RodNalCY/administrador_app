<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedor';
    protected $primaryKey = 'IdProveedor'; 
    protected $guarded = ['IdProveedor'];
    protected $fillable = [
        'Nombre', 
        'Dni', 
        'Ruc', 
        'Direccion', 
        'Email', 
        'Telefono', 
        'Banco', 
        'Cuenta', 
        'Estado', 
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}