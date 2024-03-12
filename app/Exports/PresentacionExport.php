<?php

namespace App\Exports;

use App\Models\Presentacion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PresentacionExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            [
                'Id',
                'Nombre',
                'Estado',
                'Fecha Creación',
                'Fecha Actualización',
            ],
        ];
    }


    public function collection()
    {
        return Presentacion::selectRaw('
        presentacion.idPresentacion,
        presentacion.Descripcion,
        presentacion.Estado,
        DATE_FORMAT(presentacion.created_at, "%d-%m-%Y %H:%i:%s") AS fecha_created,
        DATE_FORMAT(presentacion.updated_at, "%d-%m-%Y %H:%i:%s") AS fecha_updated')
        ->get();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Aplicar estilo al encabezado
                $event->sheet->getStyle('A1:E1')->applyFromArray([
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
