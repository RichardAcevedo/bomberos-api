<?php

namespace App\Exports;

use App\Models\EmpleadoCondecoracion;

use App\Models\Empleado;
use App\Models\Persona;
use App\Models\TipoCondecoracion;

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

class EmpleadoCondecoracionExport implements FromCollection, WithCustomStartCell,
    Responsable, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'Condecoraciones.xlsx';
    
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
                'DESCRIPCION', 'EMPLEADO', 'TIPO CONDECORACION'
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
                $headerRange = 'A2:H2'; // All headers (Ver hasta donde va cada archivo)
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
                $filas = EmpleadoCondecoracion::all(); // Modelo especifico
                $cantidad = count($filas) + 2; // 2 contando el espacio y el titulo
                $contentRange = 'A2:H' . $cantidad;
                $event->sheet->getDelegate()->getStyle($contentRange)->applyFromArray($styleArray);
            },
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $condecoraciones = EmpleadoCondecoracion::all();
        foreach ($condecoraciones as $condecoracion) {
            $tipo = TipoCondecoracion::find($condecoracion->id_tipo_condecoracion);
            $empleado = Empleado::find($condecoracion->id_empleado);
            $persona = Persona::find($empleado->id_persona);
            $condecoracion->empleado = $persona->nombre . " (" . $empleado->codigo . ")";
            $condecoracion->tipo_condecoracion = $tipo->nombre;
            unset($condecoracion->id_empleado);
            unset($condecoracion->id_tipo_condecoracion);
            // ocultar
            unset($condecoracion->created_at);
            unset($condecoracion->updated_at);
        }
        return $condecoraciones;
    }
}
