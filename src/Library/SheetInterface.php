<?php

namespace Pishgaman\Sheet\Library;

interface SheetInterface
{
    //start to make excel
    public function init();

    public function setFormatCode($spreadsheet,$Cell,$format,$setFormatCode,$index);
    public function setAutoSize($spreadsheet,$index,$Column);

    public function mergeCells($spreadsheet,$range);
    public function unmergeCells($spreadsheet,$range);

    //create worksheet
    public function createSheet($spreadsheet);

    //delete worksheet
    public function removeSheet($spreadshee,$sheetIndex);

    //Export array to excel file
    public function arrayExport($spreadsheet,$arrayData,$i=0,$rtl=true);

    //create excele file
    public function createWriter($spreadsheet);

    //
    public function putInServer($spreadsheet,$path,$name);
}
