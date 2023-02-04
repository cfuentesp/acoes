<?php

namespace App\Exports;

use App\User;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\withMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class inventario implements FromCollection,WithHeadings,WithDrawings,WithCustomStartCell,WithEvents,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Queueable, SerializesModels;

    public $equipos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($equipos)
    {
        $this->equipos = $equipos;
    }
    
    use Exportable;

    public function headings(): array
    {
        return [
            'Tipo equipo',
            'Marca equipo',
            'Modelo equipo',
            'Especificaciones equipo',
            'Color equipo',
            'Numero equipo',
            'Fecha ingreso equipo',
        ];
    }
    
    
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Acoes');
        $drawing->setPath(public_path('/images/acoes.png'));
        $drawing->setHeight(150);
        $drawing->setCoordinates('B3');

        return $drawing;
    }

    public function startCell(): string{
        return 'A14';
    }

    public function registerEvents(): array {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A14:G14'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(15);
                $styleArray = [
                    'borders' => [
                        'font' => [
                            'bold' => true,
                        ],

                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'black'],
                        ],
                        'borders' => [
                            'top' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            ],
                        ],
                    ],
                ];
                
                $event->sheet->getStyle('A14:G14')->applyFromArray($styleArray);
                $event->sheet->setCellValue('B12', 'Reporte de inventario');
                $event->sheet->getDelegate()->getStyle('B12')->getFont()->setSize(15);
            },        
        ];
    }

    public function collection()
    {
         //$equipos = DB::table('inventario')->select('TIP_EQUIPO','MRC_EQUIPO','MDL_SERIE','ECF_TECNICAS','CLR_EQUIPO','NUM_EQUIPO','FEC_INGRESO')->get();
         return $this->equipos;
    }
}