# Pishgaman-Sheet

This is a comprehensive Laravel package for getting Excel and PDF output. phpspreadsheet And mpdf are the libraries used in this package.

### How to Install Your Project
```
composer require pishgaman/sheet
```

### How to Use

#### Export Excel
```
$sheet =\App::make(SheetInterface::class);
$Spreadsheet = $sheet->init();
$spreadsheet = $sheet->createSheet($Spreadsheet,'test');
$arrayData = [];
$arrayData[0] =['name'];
$spreadsheet = $sheet->arrayExport($spreadsheet,$arrayData,0);
$sheet->createWriter($spreadsheet);
```

