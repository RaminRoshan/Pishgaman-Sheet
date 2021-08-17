<?php

namespace Pishgaman\Sheet\Library;

interface MpdfInterface
{   
    //for test package 
    public function Hello();

    //Convert Html String to PDF
    public function stringToPdf($stringVariable,$path='');

    //Convert url web to PDF
    public function urlToPdf($url);

    public function save($mpdf,$stringVariable,$path='');
    
    public function SetDirectionality($mpdf,$direction);

    public function SetDefaultBodyCSS($mpdf,$Properties,$value);

    public function Bookmark($mpdf,$Bookmark);

    public function SetTitle($mpdf,$title);

    public function init($mode,$SetDisplayMode,$format);

}
