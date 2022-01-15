<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Table\Traits;

trait WithToggleColumns {

    public $toggleColumns;

     /**
     * default false
     * @return $this
     */
    public function showToggleColumns(): TableComponent
    {
        $this->toggleColumns = true;

        return $this;
    }

}