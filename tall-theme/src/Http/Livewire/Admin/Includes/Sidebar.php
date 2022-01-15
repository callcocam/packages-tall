<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Theme\Http\Livewire\Admin\Includes;

use Livewire\Component;

class Sidebar extends Component
{

     protected function menus(){
         if(class_exists('App\Helpers\LoadMenuHelper')){
              return app('App\Helpers\LoadMenuHelper')->menus();
         }
        return [];
     }

    public function render()
    {
        return view('tall-theme::livewire.admin.includes.sidebar')->with('menus', $this->menus());
    }
}
