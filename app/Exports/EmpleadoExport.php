<?php

namespace App\Exports;

use App\Models\Empleado;

use App\Models\TipoUsuario;
use App\Models\Ciudad;
use App\Models\Departamento;
use App\Models\Persona;

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

class EmpleadoExport implements FromCollection, WithCustomStartCell,
    Responsable, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'Empleados.xlsx';
    
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
                'ID', 'CODIGO', 'NPIB', 'CONTRASEÑA(ENCRIPTACION DE SEGURIDAD)', 'FECHA INGRESO',
                'ACTIVO', 'RADICACION', 'PASAPORTE', 'SEGURO', 'TIPO CASA', 'PERSONAS A CARGO',
                'ACTIVIDAD', 'LABOR', 'MAQUINA', 'COMPUTADOR', 'HOBI', 'TIPO USUARIO', 'CIUDAD',
                'PERSONA'
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
                $headerRange = 'A2:S2'; // All headers (Ver hasta donde va cada archivo)
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
                $filas = Empleado::all(); // Modelo especifico
                $cantidad = count($filas) + 2; // 2 contando el espacio y el titulo
                $contentRange = 'A2:S' . $cantidad;
                $event->sheet->getDelegate()->getStyle($contentRange)->applyFromArray($styleArray);
            },
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $empleados = Empleado::all();
        foreach ($empleados as $empleado) {
            $tipoUsuario = TipoUsuario::find($empleado->id_tipo_usuario);
            $empleado->tipo_usuario = $tipoUsuario->nombre;
            $ciudad = Ciudad::find($empleado->id_ciudad);
            $departamento = Departamento::find($ciudad->id_departamento);
            $empleado->ciudad = $ciudad->nombre . ", " . $departamento->nombre;
            $persona = Persona::find($empleado->id_persona);
            $empleado->persona = $persona->nombre;
            unset($empleado->id_tipo_usuario);
            unset($empleado->id_ciudad);
            unset($ciudad->id_departamento);
            unset($empleado->id_persona);
            // ocultar
            unset($empleado->acceso_huella);
            unset($empleado->created_at);
            unset($empleado->updated_at);
        }
        // dd($empleados);
        return $empleados;
    }
}
