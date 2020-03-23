<?php

namespace App\Exports;

use App\Models\Empresa;

use App\Models\TipoEmpresa;
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

class EmpresaExport implements FromCollection, WithCustomStartCell,
    Responsable, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'Empresas.xlsx';
    
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
                'ID', 'NOMBRE', 'DIRECCION', 'BARRIO', 'REGISTRO CAMARA', 'TELEFONO',
                'FECHA REGISTRO', 'REPRESENTANTE', 'CELULAR', 'CEDULA', 'NIT', 'OBSERVACION',
                'SN', 'CANTIDAD', 'AREA', 'CATEGORIA', 'NIVEL', 'INSPECTOR', 'TIPO EMPRESA'
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
                $filas = Empresa::all(); // Modelo especifico
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
        $empresas = Empresa::all();
        foreach ($empresas as $empresa) {
            $supervisor = Empleado::find($empresa->id_inspector);
            $persona = Persona::find($supervisor->id_persona);
            $empresa->inspector = $persona->nombre . " (" . $supervisor->codigo . ")";
            unset($empresa->id_inspector);
            $tipoEmpresa = TipoEmpresa::find($empresa->id_tipo_empresa);
            unset($empresa->id_tipo_empresa);
            $empresa->tipo_empresa = $tipoEmpresa->nombre;
            // ocultar
            unset($empresa->created_at);
            unset($empresa->updated_at);
        }
        return $empresas;
    }
}
