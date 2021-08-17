<?php

namespace Pishgaman\Sheet\Library;

use Pishgaman\Sheet\Library\MpdfInterface;
use Illuminate\Support\Facades\Log;

class Mpdf implements MpdfInterface
{
    private $mpdf;
    
    public function __construct()
    {
        require_once 'mpdf/vendor/autoload.php';
        $this->mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
        $this->mpdf->autoScriptToLang = true;
        $this->mpdf->autoLangToFont = true;
        $this->mpdf->SetDisplayMode('fullpage');
    }

    //for test package 
    public function Hello()
    {
        $this->mpdf->WriteHTML('<h1>Hello world!</h1>');
        $this->mpdf->Output();
    }

    //Convert Html String to PDF
    public function stringToPdf($stringVariable,$path='')
    {
        $this->mpdf->WriteHTML($stringVariable);
        if($path == '')
            $this->mpdf->Output();
        else
        {
            $this->mpdf->Output($path,'F');
            return true;
        }
    }

    //Convert url web to PDF
    public function urlToPdf($url,$direction='rtl')
    {
        $html = file_get_contents($url);
        $first_step = explode( '<urlToPdf>' , $html );
        $second_step = explode("</urlToPdf>" , $first_step[1] );
        $this->mpdf->SetDirectionality($direction);
        $this->mpdf->WriteHTML($second_step[0]);
        $this->mpdf->Output();
    }

    public function save($mpdf,$stringVariable,$path='')
    {
        $mpdf->WriteHTML($stringVariable);
        if($path == '')
            $mpdf->Output();
        else
        {
            $mpdf->Output($path,'F');
            return true;
        }
    }
    
    public function SetDirectionality($mpdf,$direction)
    {
        return $mpdf->SetDirectionality($direction);
    }

    public function SetDefaultBodyCSS($mpdf,$Properties,$value)
    {
        return $mpdf->SetDefaultBodyCSS(($Properties ?? 'color'),($value ?? 'black)'));
    }

    public function Bookmark($mpdf,$Bookmark)
    {
        return $mpdf->Bookmark($Bookmark ?? 'میز خدمت الکترونیک دانشگاه رازی');
    }

    public function SetTitle($mpdf,$title)
    {
        return $mpdf->SetTitle($title ?? 'My Title');
    }

    public function init($mode , $SetDisplayMode , $format)
    {
        require_once 'mpdf/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf(['mode' => ($mode ?? 'utf-8'),'format'=>($format ?? 'A4-L')]);
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->autoArabic = true;
        $mpdf->showImageErrors = true;
        $mpdf->SetDisplayMode(($SetDisplayMode ?? 'fullpage'));        
        return $mpdf;
    }
}
