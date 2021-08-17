<?php

namespace Pishgaman\Sheet;

use Illuminate\Support\ServiceProvider;
use Pishgaman\Sheet\Library\phpspreadsheet;
use Pishgaman\Sheet\Library\SheetInterface;
use Pishgaman\Sheet\Library\Mpdf;
use Pishgaman\Sheet\Library\MpdfInterface;

class SheetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(SheetInterface::class , phpspreadsheet::class);
        $this->app->bind(MpdfInterface::class , Mpdf::class);
    }
}
