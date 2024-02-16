<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentasLog extends Model
{
    use HasFactory;

    protected $table = 'ventas_log';
    protected $primaryKey = 'id'; 
    protected $guarded = ['id'];
    protected $fillable = [
        'comp_id',
        'ventas_id',
        'comp_name',
        'fecha_venta',
        'dia_venta',
        'vendedor_id',
        'cliente_id',
        'valor_total',
        'texto_valor_total',
        'ruta_comprobante',
        'created_at',
        'updated_at',
        'deleted_at ',
    ];
}
