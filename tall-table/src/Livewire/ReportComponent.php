<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Table\Livewire;

use Livewire\Component;
use Tall\Form\Traits\Message;
use WireUi\Traits\Actions;
use Tall\Report\Models\Report;
use Illuminate\Database\Eloquent\Collection;
use Tall\Report\Traits\Exportable;
use Tall\Report\Types\{ExportToCsv, ExportToXLS};
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportComponent extends Component 
{
    use Message,Actions,Exportable; 

    public $model;

    public function mount(Report $model)
    {
        
        $this->model = $model;
    }

    public function query (){

        return app($this->model->model)->query();
 
    }
    
    /**
     * @throws Throwable
     */
    public function exportToXLS(bool $selected = false): BinaryFileResponse|bool
    {
        return $this->export(ExportToXLS::class, $selected);
    }

    /**
     * @throws Throwable
     */
    public function exportToCsv(bool $selected = false): BinaryFileResponse|bool
    {

        return $this->export(ExportToCsv::class, $selected);
    }

     /**
     * @throws Exception | Throwable
     */
    private function export(string $exportableClass, bool $selected): BinaryFileResponse|bool
    {
        /**
         * @var ExportToCsv|ExportToCsv $exportable
         */
        $exportable = new $exportableClass();

        $columns = $this->model->columns->toArray();


        /** @var string $fileName */

        $fileName = data_get($this->model, 'slug');
        $exportable->fileName($fileName)
            ->setData($columns, $this->prepareToExport($selected));

        return $exportable->download([]);
    }

    public function render()
    {
        return view("tall-table::livewire.report-component");
    }

}
