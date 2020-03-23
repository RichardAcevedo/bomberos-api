<?php

namespace App\Exports;

use App\Models\Log;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// Styling
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class LogExport implements FromCollection, WithCustomStartCell,
    Responsable, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'Logs.xlsx';
    
    /**
    * Optional Writer Type
    */
    private $writerType = Excel::XLSX;
    
    /**
    * Optional headers
    */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function headings(): array
    {
        return [
            // ['BOMBEROS VOLUNTARIOS VILLA DEL ROSARIO'],
            [
                'ID', 'ACCION', 'TABLA AFECTADA', 'ID AFECTADO', 'INICIAL', 'FINAL',
                'URL', 'IP', 'DESDE', 'FECHA', 'HORA'
            ]
        ];
    }

    public function startCell(): string
    {
        return 'A2';
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $headerRange = 'A2:K2'; // All headers (Ver hasta donde va cada archivo)
                // titulo en negrita:
                $event->sheet->getDelegate()->getStyle($headerRange)->getFont()->setBold(true);
                // cambiar color:
                // $event->sheet->getDelegate()->getStyle($headerRange)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
                // estilo de bordes:
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                // abarcar todos los datos:
                $filas = DB::table('log')->get(); // Modelo especifico
                $cantidad = count($filas) + 2; // 2 contando el espacio y el titulo
                $contentRange = 'A2:K' . $cantidad;
                $event->sheet->getDelegate()->getStyle($contentRange)->applyFromArray($styleArray);
            },
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $logs = DB::table('log')->get();
        foreach ($logs as $log) {
            $log->event = $log->event == "created" ? "Creación" : $log->event;
            $log->event = $log->event == "updated" ? "Actualización" : $log->event;
            $log->event = $log->event == "deleted" ? "Eliminación" : $log->event;
            $log->event = $log->event == "restored" ? "Restauración" : $log->event;
            $createdAt = explode(" ", $log->created_at);
            $log->date = $createdAt[0];
            $log->hour = $createdAt[1];
            $log->auditable_type = explode("App\\Models\\", $log->auditable_type)[1];
            // ocultar
            unset($log->user_type);
            unset($log->user_id);
            unset($log->tags);
            unset($log->created_at);
            unset($log->updated_at);
        }
        return $logs;
    }
}
