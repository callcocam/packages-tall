<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Form\Fields;

use Tall\Form\Field;

class Submit extends Field 
{
    protected $type         =	"submit";
    protected $xs           =	false;
    protected $md           =	false;
    protected $lg           =	false;
    protected $primary      =	false;
    protected $secondary    =	false;
    protected $positive     =	false;
    protected $negative     =	false;
    protected $warning      =	false;
    protected $info         =	false;
    protected $dark         =	false;
    protected $rounded      =	false;
    protected $squared      =	false;
    protected $bordered     =	false;
    protected $flat         =	false;
    protected $color        =	false;
    protected $size         =	false;
    protected $rightIcon    =	false;
    protected $spinner      =	true;
    protected $outline      =	false;

    public function xs(){
        $this->xs = true;
        return $this;
    }

    public function md(){
        $this->md = true;
        return $this;
    }

    public function lg(){
        $this->lg = true;
        return $this;
    }
    
    public function primary(){
        $this->primary = true;
        return $this;
    }
    
    public function secondary(){
        $this->secondary = true;
        return $this;
    }
    
    public function positive(){
        $this->positive = true;
        return $this;
    }
    
    public function warning(){
        $this->warning = true;
        return $this;
    }
    
    public function info(){
        $this->info = true;
        return $this;
    }
    
    public function dark(){
        $this->dark = true;
        return $this;
    }
    
    public function rounded(){
        $this->rounded = true;
        return $this;
    }
    
    public function squared(){
        $this->squared = true;
        return $this;
    }
    
    public function bordered(){
        $this->bordered = true;
        return $this;
    }
    
    public function flat(){
        $this->flat = true;
        return $this;
    }
    
    public function color($color){
        $this->color = $color;
        return $this;
    }
    
    public function size($size){
        $this->size = $size;
        return $this;
    }
    
    public function spinner($spinner){
        $this->spinner = $spinner;
        return $this;
    }
    
    public function outline(){
        $this->outline = true;
        return $this;
    }
}
