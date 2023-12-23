<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $guarded = ['IdVenta'];
    protected $fillable = [
        'Serie',
        'Numero',
        'Fecha',
        'VentaTotal',
        'Descuento',
        'SubTotal',
        'Igv',
        'Total',
        'Estado',
        'idCliente ',
        'idEmpleado',
        'idTipoComprobante',
    ];
}
