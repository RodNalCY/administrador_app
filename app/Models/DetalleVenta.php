<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalleventa';
    public $incrementing = false; // Indica que no se espera una clave primaria autoincremental
    public $timestamps = false;
    
    protected $fillable = [
        'IdVenta',
        'idProducto',
        'Cantidad',
        'Costo',
        'Precio',
        'Importe',
    ];
}
