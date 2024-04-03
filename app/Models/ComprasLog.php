<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprasLog extends Model
{
    use HasFactory;

    protected $table = 'compras_log';
    protected $primaryKey = 'id'; 
    protected $guarded = ['id'];
    protected $fillable = [
        'compra_id',
        'comp_id',
        'comp_name',
        'fecha_compra',
        'dia_compra',
        'valor_total',
        'texto_valor_total',
        'created_at',
        'updated_at',
        'deleted_at ',
    ];
}
