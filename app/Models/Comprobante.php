<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tipocomprobante';
    protected $primaryKey = 'idTipoComprobante';     
    protected $guarded = ['idTipoComprobante'];
    protected $fillable = [
        'Descripcion', 
        'Estado', 
    ];
}