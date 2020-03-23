<?php

namespace App\Exports;

use App\Models\ExtintorCliente;

use App\Models\TipoExtintor;
use App\Models\Cliente;
use App\Models\Empresa;

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

class ExtintorClienteExport implements FromCollection, WithCustomStartCell,
    Responsable, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'Extintores.xlsx';
    
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
                'ID', 'FECHA', 'NOTA DE SERVICIO', 'CAPACIDAD', 'TARIFA', 'TIPO EXTINTOR',
                'CLIENTE', 'EMPRESA'
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
                $filas = ExtintorCliente::all(); // Modelo especifico
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
        $extintores = ExtintorCliente::all();
        foreach ($extintores as $extintor) {
            $tipoExtintor = TipoExtintor::find($extintor->id_tipo_extintor);
            $extintor->tipo_extintor = $tipoExtintor->nombre;
            unset($extintor->id_tipo_extintor);
            $cliente = Cliente::find($extintor->id_cliente);
            $extintor->cliente = $cliente->nombre;
            unset($extintor->id_cliente);
            $empresa = Empresa::find($extintor->id_empresa);
            $extintor->empresa = $empresa->nombre;
            unset($extintor->id_empresa);
            // ocultar
            unset($extintor->created_at);
            unset($extintor->updated_at);
        }
        return $extintores;
    }
}
