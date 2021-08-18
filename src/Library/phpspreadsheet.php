<?php

namespace Pishgaman\Sheet\Library;

use Pishgaman\Sheet\Library\SheetInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\File;

class phpspreadsheet implements SheetInterface
{
    public function __construct()
    {
        require 'phpspreadsheet/vendor/autoload.php';
    }

    public function arrayExport($spreadsheet,$arrayData,$i=0,$rtl=true)
    {
        $spreadsheet->getSheet($i)->setRightToLeft($rtl)
            ->fromArray(
                $arrayData,
                NULL,
                'A1'                 
            );
        return $spreadsheet;
    }

    public function createWriter($spreadsheet)
    {
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $name = date('his') . '.xls';
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');

        // It will be called file.xls
        header('Content-Disposition: attachment; filename="file.xlsx"');
        $writer->save('php://output');

        return base_path('../media/excel/' . $name);
    }

    public function putInServer($spreadsheet,$path='public/cache',$name='pishgaman')
    {
        try {
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save(base_path($path.'/'.$name.'.Xlsx'));
            $url = url($path.'/'.$name.'.Xlsx');            
        } catch (\Throwable $th) {
            File::makeDirectory(base_path($path));
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save(base_path($path.'/'.$name.'.Xlsx'));
            $url = url($path.'/'.$name.'.Xlsx');            
        }

        return [
            'url'=>$url,
            'fileName'=>$name.'.Xlsx'
        ];

    }

    public function init()
    {
        $spreadshee = new Spreadsheet();
        $this->removeSheet($spreadshee,0);
        return $spreadshee;
    }

    public function mergeCells($spreadsheet,$range)
    {
        $spreadsheet->getActiveSheet()->mergeCells($range);
    }

    public function unmergeCells($spreadsheet,$range)
    {
        $spreadsheet->getActiveSheet()->unmergeCells($range);
    }

    public function setFormatCode($spreadsheet,$Cell,$format,$setFormatCode,$index)
    {
        $spreadsheet->getActiveSheet()->getStyle($Cell)->$format()->setFormatCode($setFormatCode);
    }

    public function setAutoSize($spreadsheet,$index,$Column)
    {
        $index ? $spreadsheet->getSheet($index)->getColumnDimension($Column)->setAutoSize(true): $spreadsheet->getActiveSheet()->getColumnDimension($Column)->setAutoSize(true);
    }
    public function createSheet($spreadsheet,$name='Another sheet',$rtl=true)
    {
        $worksheet1 = $spreadsheet->createSheet()->setRightToLeft($rtl);
        $worksheet1->setTitle($name);
        return $spreadsheet ;
    }
    public function removeSheet($spreadshee,$sheetIndex)
    {
        $spreadshee->removeSheetByIndex($sheetIndex);
    }
}
