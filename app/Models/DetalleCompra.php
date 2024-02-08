<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;

    protected $table = 'detallecompra';
    public $incrementing = false; // Indica que no se espera una clave primaria autoincremental
    public $timestamps = false;
    
    protected $fillable = [
        'idCompra',
        'idProducto',
        'Cantidad',
        'Costo',
        'Importe',
    ];
}
