<?php

namespace App\Exports;

use App\Models\EmpleadoEducacion;

use App\Models\Empleado;
use App\Models\Persona;
use App\Models\Ciudad;
use App\Models\Departamento;

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

class EmpleadoEducacionExport implements FromCollection, WithCustomStartCell,
    Responsable, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'Educaciones (Empleados).xlsx';
    
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
                'ID', 'INSTITUCION', 'TITULO OBTENIDO', 'FECHA', 'TERMINADO', 'CIUDAD',
                'EMPLEADO'
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
                $headerRange = 'A2:G2'; // All headers (Ver hasta donde va cada archivo)
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
                $filas = EmpleadoEducacion::all(); // Modelo especifico
                $cantidad = count($filas) + 2; // 2 contando el espacio y el titulo
                $contentRange = 'A2:G' . $cantidad;
                $event->sheet->getDelegate()->getStyle($contentRange)->applyFromArray($styleArray);
            },
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $educaciones = EmpleadoEducacion::all();
        foreach ($educaciones as $educacion) {
            // $bitacora->atributos = json_decode($bitacora->atributos);
            $ciudad = Ciudad::find($educacion->id_ciudad);
            $departamento = Departamento::find($ciudad->id_departamento);
            $educacion->ciudad = $ciudad->nombre . ", " . $departamento->nombre;
            $empleado = Empleado::find($educacion->id_empleado);
            $persona = Persona::find($empleado->id_persona);
            $educacion->empleado = $persona->nombre . " (" . $empleado->codigo . ")";
            unset($educacion->id_ciudad);
            unset($educacion->id_empleado);
            // ocultar
            unset($educacion->created_at);
            unset($educacion->updated_at);
        }
        return $educaciones;
    }
}
