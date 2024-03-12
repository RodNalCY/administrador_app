<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ProductoExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    public function headings(): array
    {
        return [
            [
                'Id',
                'Descripción',
                'Concentración',
                'Stock',
                'Costo',
                'Precio',
                'Registro Sanitario',
                'Estado',
                'Presentación',
                'Laboratorio',
                'Fecha Vencimiento',
                'Fecha Creación',
                'Fecha Actualización',
            ],
        ];
    }

    public function collection()
    {
        return Producto::selectRaw('           
        producto.idProducto AS idProducto,
        producto.Descripcion AS nombre,
        producto.Concentracion AS Concentracion,
        CASE WHEN producto.Stock = 0 THEN "0" ELSE producto.Stock END AS Stock_convertido,
        producto.Costo AS Costo,
        producto.Precio_Venta AS Precio_Venta,
        producto.RegistroSanitario AS RegistroSanitario,
        producto.Estado AS Estado,
        presentacion.Descripcion AS presentacion,
        laboratorio.Nombre AS laboratorio,
        producto.FechaVencimiento AS FechaVencimiento,
        DATE_FORMAT(producto.created_at, "%d-%m-%Y %H:%i:%s") AS fecha_created,
        DATE_FORMAT(producto.updated_at, "%d-%m-%Y %H:%i:%s") AS fecha_updated')
            ->join('presentacion', 'presentacion.idPresentacion', '=', 'producto.idPresentacion')
            ->join('laboratorio', 'laboratorio.idLaboratorio', '=', 'producto.idLaboratorio')
            ->get();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Aplicar estilo al encabezado
                $event->sheet->getStyle('A1:M1')->applyFromArray([
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
