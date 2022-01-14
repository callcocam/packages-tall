<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Table\Traits;

use Tall\Table\Fields\Action;

trait WithExport {

      
    public function ExportCsv($type)
    {
      
        return ;
    }
      
    public function ExportXlsx($type)
    {
        //dd($this->checkboxValues,$type);
        
        return ;
    }

    public function getExportsHeaders()
    {
        return  Action::make('Export')
        ->groups([               
            Action::make('Export CSV')
                ->dialog([
                    'method'=>'ExportCsv',
                    'params'=>'csv'
                ])->icon('ms-excel'),
            Action::make('Export XLSX')
                ->dialog([
                    'method'=>'ExportXlsx',
                    'params'=>'xlsx'
                ])->icon('ms-excel')
        ])
        ->icon('ms-excel');
    }
}