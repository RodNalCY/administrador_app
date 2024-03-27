<?php

namespace App\Exports;

use App\Models\Ventas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class CajaResumenDiarioExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $fecha;

    public function __construct($fechita)
    {
        $this->fecha = $fechita;
    }

    public function headings(): array
    {
        return [
            [
                'Id Producto',
                'Nombres / Concentración / Presentación',
                'Cantidad',
                'Costo',
                'Costo Total',
                'Precio',
                'Importe Total',
                'Ganancias',
                'Fecha de Venta',
            ],
        ];
    }

    public function collection()
    {

        return Ventas::selectRaw(
        'producto.idProducto, 
        CONCAT(producto.Descripcion, " / ", producto.Concentracion, " / ", presentacion.Descripcion) as Descripcion,
        SUM( detalleventa.Cantidad ) AS cantidades, 
        detalleventa.Costo, 
        SUM( detalleventa.Cantidad * detalleventa.Costo ) AS costo_total,    
        detalleventa.Precio,     
        SUM( detalleventa.Importe ) AS importe,       
        SUM( detalleventa.Importe ) - SUM( detalleventa.Cantidad * detalleventa.Costo ) AS ganancias, 
        ventas_log.fecha_venta'
        )
            ->join('detalleventa', 'ventas.IdVenta', '=', 'detalleventa.IdVenta')
            ->join('producto', 'detalleventa.idProducto', '=', 'producto.idProducto')
            ->join('presentacion', 'producto.idPresentacion', '=', 'presentacion.idPresentacion')
            ->join('ventas_log', 'detalleventa.IdVenta', '=', 'ventas_log.venta_id')
            ->where('ventas.Fecha', $this->fecha)
            ->groupBy('producto.idProducto', 'producto.Descripcion', 'detalleventa.Costo', 'detalleventa.Precio', 'detalleventa.Importe', 'ventas.Fecha', 'presentacion.Descripcion', 'ventas_log.fecha_venta')
            ->orderBy('ventas_log.fecha_venta', 'DESC')
            ->get();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Aplicar estilo al encabezado
                $event->sheet->getStyle('A1:I1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '2F75B5'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}
