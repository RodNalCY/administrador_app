<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'compra';
    protected $primaryKey = 'idCompra'; 
    protected $guarded = ['idCompra'];
    protected $fillable = [
        'Numero',
        'Fecha',
        'TipoPago',
        'SubTotal',
        'Total',
        'Igv',
        'Estado',
        'idProveedor',
        'idEmpleado',
        'idTipoComprobante',
    ];
}
