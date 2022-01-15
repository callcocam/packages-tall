<?php 
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Table\Traits;

/**
 * WithCheckbox
 */
trait WithCheckbox
{
    public $checkbox = true;
    
    public $checkboxAttribute = "id";

    public bool $checkboxAll = false;

    public $checkboxAllCurrentPage = [];

    public $checkboxValues = [];

    public function updatedCheckboxValues($value)
    {
       
        if($value){
            /** @var AbstractPaginator $data */
            $data = $this->fillData();
            collect($data->items())->each(function ($model) use($value) {
                $key = \Arr::get($model, $this->checkboxAttribute);
                //Marca como selecionado se o id seleciona for igual id da model
                if($key == $value){
                    $this->checkboxValues[$this->page][$value] = (string) $model->{$this->checkboxAttribute};
                }
                else{
                    //se não existir um index cria como false, se não passa e mante o id ou false
                    if(!isset($this->checkboxValues[$this->page][$key])){
                        $this->checkboxValues[$this->page][$key] = false;
                    }
                }                    
            });
            //iniciao como tu selecionado
            $this->checkboxAll = true;  
            //inicia como a pagina selecionada
            $this->checkboxAllCurrentPage[$this->page] = true;
            //perrcorre pra ver se a um item false se ouver desmarca selectAll 
            //e a currente pagina com tu selecionado
            collect($this->checkboxValues[$this->page])->each(function ($value) {
              if(!$value){
                $this->checkboxAll = false;  
                unset($this->checkboxAllCurrentPage[$this->page]);
              }
            });
        }
        else{
            //se entraar aqui e sinal de que não esta tudo selecionado
            $this->checkboxAll = false;
            if(isset($this->checkboxAllCurrentPage[$this->page])){
                unset($this->checkboxAllCurrentPage[$this->page]);
            }
        }
      
    }


   /**
     * @throws Exception
     */
    public function selectCheckboxAll(): void
    {
     
        if (!$this->checkboxAll) {
            if(isset($this->checkboxValues[$this->page])){
              unset($this->checkboxValues[$this->page]);
            }
            if(isset($this->checkboxAllCurrentPage[$this->page])){
                unset($this->checkboxAllCurrentPage[$this->page]);
            }
            return;
        }

        /** @var AbstractPaginator $data */
        $data = $this->fillData();

        collect($data->items())->each(function ($model) {
            $key = $model->{$this->checkboxAttribute};
            $this->checkboxValues[$this->page][$key] = (string) $key;
        });

       
    }

    
    public function showCheckBox(string $attribute = 'id'): TableComponent
    {
        $this->checkbox          = true;
        $this->checkboxAttribute = $attribute;

        return $this;
    }
    
    public function checkboxValuesCount()
    {
        $data = collect(\Arr::get($this->checkboxValues, $this->page,[]))->filter(function($item){
            return $item !==false;
         });        
         return $data->count();
    }
}
