<?php

namespace App\Exports;

use App\Models\Proveedor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ProveedorExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
                'DNI',
                'Ruc',
                'Dirección',
                'Email',
                'Teléfono',
                'Banco',
                'Cuenta',
                'Estado',
                'Fecha Creación',
                'Fecha Actualización',
            ],
        ];
    }

    public function collection()
    {
       return Proveedor::selectRaw('
        proveedor.IdProveedor,
        proveedor.Nombre,
        proveedor.Dni,
        proveedor.Ruc,
        proveedor.Direccion,
        proveedor.Email,
        proveedor.Telefono,
        proveedor.Banco,
        proveedor.Cuenta,
        proveedor.Estado,
        DATE_FORMAT(proveedor.created_at, "%d-%m-%Y %H:%i:%s") AS fecha_created,
        DATE_FORMAT(proveedor.updated_at, "%d-%m-%Y %H:%i:%s") AS fecha_updated')
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
