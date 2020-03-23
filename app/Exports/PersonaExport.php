<?php

namespace App\Exports;

use App\Models\Persona;

use App\Models\TipoSangre;
use App\Models\Ciudad;
use App\Models\Departamento;
use App\Models\Profesion;

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

class PersonaExport implements FromCollection, WithCustomStartCell,
    Responsable, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'Personas.xlsx';
    
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
                'ID', 'NOMBRE', 'FECHA NACIMIENTO', 'SEXO', 'VIVE',
                'BARRIO', 'DIRECCION', 'TELEFONO', 'CELULAR', 'ESTADO CIVIL', 'DOCUMENTO',
                'ESTATURA', 'PERSO', 'EMAIL', 'FOTOGRAFIA', 'TIPO SANGRE', 'CIUDAD NACIMIENTO', 'PROFESION'
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
                $headerRange = 'A2:R2'; // All headers (Ver hasta donde va cada archivo), cambiar tambien en contentRange
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
                $filas = Persona::all(); // Modelo especifico
                $cantidad = count($filas) + 2; // 2 contando el espacio y el titulo
                $contentRange = 'A2:R' . $cantidad;
                $event->sheet->getDelegate()->getStyle($contentRange)->applyFromArray($styleArray);
            },
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $personas = Persona::all();
        foreach ($personas as $persona) {
            $tipoSangre = TipoSangre::find($persona->id_tipo_sangre);
            $persona->tipo_sangre = $tipoSangre->nombre;
            $ciudadNacimiento = Ciudad::find($persona->id_ciudad_nacimiento);
            $departamentoNacimiento = Departamento::find($ciudadNacimiento->id_departamento);
            $persona->ciudad_nacimiento = $ciudadNacimiento->nombre . ", " . $departamentoNacimiento->nombre;
            $profesion = Profesion::find($persona->id_profesion);
            $persona->profesion = $profesion->nombre;
            $persona->fotografia = $persona->fotografia ? '[Adjunta]' : $persona->fotografia;
            unset($persona->id_tipo_sangre);
            unset($persona->id_ciudad_nacimiento);
            unset($persona->id_profesion);
            // ocultar
            unset($persona->created_at);
            unset($persona->updated_at);
        }
        return $personas;
    }
}
