<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    use HasFactory;

    protected $table = 'presentacion';
    protected $primaryKey = 'idPresentacion'; 
    protected $guarded = ['idPresentacion'];
    protected $fillable = [
        'Descripcion', 
        'Estado', 
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
