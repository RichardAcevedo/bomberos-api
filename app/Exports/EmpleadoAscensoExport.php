<?php

namespace App\Exports;

use App\Models\EmpleadoAscenso;

use App\Models\Empleado;
use App\Models\Persona;
use App\Models\Rango;

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

class EmpleadoAscensoExport implements FromCollection, WithCustomStartCell,
    Responsable, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'Ascensos.xlsx';
    
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
                'ID', 'FECHA ACTA', 'FECHA RESOLUCION', 'CODIGO ACTA', 'CODIGO RESOLUCION',
                'DESCRIPCION', 'ACTIVO', 'FECHA DESACTIVACION', 'ARCHIVO SOPORTE', 'EMPLEADO',
                'RANGO'
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
                $filas = EmpleadoAscenso::all(); // Modelo especifico
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
        $ascensos = EmpleadoAscenso::all();
        foreach ($ascensos as $ascenso) {
            $rango = Rango::find($ascenso->id_rango);
            $empleado = Empleado::find($ascenso->id_empleado);
            $persona = Persona::find($empleado->id_persona);
            $ascenso->empleado = $persona->nombre . " (" . $empleado->codigo . ")";
            $ascenso->rango = $rango->nombre;
            unset($ascenso->id_empleado);
            unset($ascenso->id_rango);
            // ocultar
            unset($ascenso->created_at);
            unset($ascenso->updated_at);
        }
        return $ascensos;
    }
}
