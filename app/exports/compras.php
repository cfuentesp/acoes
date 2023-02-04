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

class compras implements FromCollection,WithHeadings,WithDrawings,WithCustomStartCell,WithEvents,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $compras;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($compras)
    {
        $this->compras = $compras;
    }
    
    use Exportable;

    public function headings(): array
    {
        return [
            'Numero de equipo',
            'Descripcion',
            'Fecha solicitud',
            'Indicador de solicitud',
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
                $event->sheet->setCellValue('B12', 'Reporte de solicitudes de compra');
                $event->sheet->getDelegate()->getStyle('B12')->getFont()->setSize(15);
            },        
        ];
    }

    public function collection()
    {
        // $compras = DB::table('sol_compra')
        // ->join('dis_mantenimiento', 'sol_compra.cod_reparacion', '=', 'dis_mantenimiento.cod_reparacion')
        // ->join('inventario', 'dis_mantenimiento.cod_equipo', '=', 'inventario.cod_equipo')
        // ->select('inventario.NUM_EQUIPO','sol_compra.DES_SOLICITUD','sol_compra.FEC_SOLICITUD','sol_compra.IND_SOLICITUD')->get();
        return $this->compras;
    }
}