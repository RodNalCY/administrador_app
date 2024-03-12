<?php

namespace App\Exports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ClienteExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            [
                'Id',
                'Nombres',
                'Apellidos',
                'Género',
                'DNI/CARNET',
                'Teléfono',
                'RUC',
                'Email',
                'Dirección',
                'Estado',
                'Fecha Creación',
                'Fecha Actualización',
            ],
        ];
    }

    public function collection()
    {
        return Cliente::selectRaw('
        cliente.idCliente,
        cliente.Nombres,
        cliente.Apellidos,
        cliente.Sexo,
        cliente.Dni,
        cliente.Telefono,
        cliente.Ruc,
        cliente.Email,
        cliente.Direccion,
        cliente.Estado,
        DATE_FORMAT(cliente.created_at, "%d-%m-%Y %H:%i:%s") AS fecha_created,
        DATE_FORMAT(cliente.updated_at, "%d-%m-%Y %H:%i:%s") AS fecha_updated')
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
