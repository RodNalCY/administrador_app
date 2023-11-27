<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';
    protected $guarded = ['idProducto'];
    protected $fillable = [
        'Descripcion', 
        'Concentracion', 
        'Stock', 
        'Costo', 
        'Precio_Venta', 
        'RegistroSanitario',
        'FechaVencimiento', 
        'Estado', 
        'idPresentacion', 
        'idLaboratorio', 
    ];

    public function presentacion()
    {
        return $this->belongsTo(Presentacion::class, 'idPresentacion', 'idPresentacion');

    }
    public function laboratorio()
    {
        return $this->belongsTo(Laboratorio::class, 'idLaboratorio', 'idLaboratorio');

    }

}
