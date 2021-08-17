<?php

namespace Pishgaman\Sheet\Library;

use Pishgaman\Sheet\Library\SheetInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
                $arrayData,  // The data to set
                NULL,        // Array values with this value will not be set
                'A1'  ,       // Top left coordinate of the worksheet range where
                             //    we want to set these values (default is A1)
                
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

    public function putInServer($spreadsheet)
    {
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save(base_path('../media/cache/putInServerDrom.xlsx'));
        return url('/media/cache/putInServerDrom.xlsx');
    }

    public function init()
    {
        $spreadshee = new Spreadsheet();
        $this->removeSheet($spreadshee,0);
        return $spreadshee;
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
