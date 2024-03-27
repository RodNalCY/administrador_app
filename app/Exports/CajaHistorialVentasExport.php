<?php

namespace App\Exports;

use App\Models\DetalleVenta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class CajaHistorialVentasExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $fecha_init;
    protected $fecha_end;

    public function __construct($fechaInit, $fechaEnd)
    {
        $this->fecha_init = $fechaInit;
        $this->fecha_end = $fechaEnd;
    }

    public function headings(): array
    {
        return [
            [
                'Id Producto',
                'Nombres',
                'Concentración',
                'Presentación',
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

        return DetalleVenta::selectRaw(
           'producto.idProducto, 
            producto.Descripcion,
            producto.Concentracion,
            presentacion.Descripcion AS presentacion, 
            SUM( detalleventa.Cantidad ) AS cantidades, 
            detalleventa.Costo, 
            SUM( detalleventa.Cantidad * detalleventa.Costo ) AS costo_total, 
            detalleventa.Precio, 
            SUM( detalleventa.Importe ) AS importe,   
            SUM( detalleventa.Importe ) - SUM( detalleventa.Cantidad * detalleventa.Costo ) AS ganancias,
            ventas.Fecha'
        )
            ->join('ventas', 'detalleventa.IdVenta', '=', 'ventas.IdVenta')
            ->join('producto', 'detalleventa.idProducto', '=', 'producto.idProducto')
            ->join('presentacion', 'producto.idPresentacion', '=', 'presentacion.idPresentacion')
            ->where('ventas.Fecha', ">=", $this->fecha_init)
            ->where('ventas.Fecha', "<=", $this->fecha_end)
            ->groupBy('producto.idProducto', 'producto.Descripcion', 'producto.Concentracion', 'presentacion.Descripcion', 'detalleventa.Costo', 'detalleventa.Precio', 'detalleventa.Cantidad', 'detalleventa.Importe', 'ventas.Fecha')
            ->orderBy('producto.idProducto', 'ASC')
            ->get();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Aplicar estilo al encabezado
                $event->sheet->getStyle('A1:L1')->applyFromArray([
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
