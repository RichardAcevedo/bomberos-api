<?php

namespace App\Exports;

use App\Models\Bitacora;

use App\Models\Asunto;
use App\Models\Empleado;
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

class BitacoraExport implements FromCollection, WithCustomStartCell,
    Responsable, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'Minutas.xlsx';
    
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
                'ID', 'FECHA', 'HORA', 'DESCRIPCION', 'ATRIBUTOS', 'ASUNTO', 'USUARIO SESION'
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
                $filas = Bitacora::all(); // Modelo especifico
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
        $bitacoras = Bitacora::all();
        foreach ($bitacoras as $bitacora) {
            // $bitacora->atributos = json_decode($bitacora->atributos);
            $asunto = Asunto::find($bitacora->id_asunto);
            $usuarioSesion = Empleado::find($bitacora->id_usuario_sesion);
            $persona = Persona::find($usuarioSesion->id_persona);
            $bitacora->asunto = $asunto->nombre;
            $bitacora->usuario_sesion = $persona->nombre . " (" . $usuarioSesion->codigo . ")";
            unset($bitacora->id_asunto);
            unset($bitacora->id_usuario_sesion);
            // ocultar
            unset($bitacora->created_at);
            unset($bitacora->updated_at);
        }
        return $bitacoras;
    }
}
