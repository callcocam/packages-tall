<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Table\Fields\Traits;

trait WithAttributes 
{
    protected $primary = true;
    protected $danger = false;
    protected $succsess = false;
    protected $dark = false;
    protected $secondary = false;
    protected $positive = false;
    protected $negative = false;
    protected $warning = false;
    protected $info = false;
    protected $lg = false;
    protected $md = false;
    protected $rounded = false;
    protected $squared = false;
    protected $bordered = false;
    protected $flat = false;
    protected $spinner = false;
    protected $rightIcon;
    protected $size = false;
    protected $color;

    public function primary()
    {
        $this->primary = true;
        return $this;
    }

    
    public function danger()
    {
        $this->primary = false;
        $this->danger = true;
        return $this;
    }
    
    public function succsess()
    {
        $this->primary = false;
        $this->succsess = true;
        return $this;
    }
   
    public function dark()
    {
        $this->primary = false;
        $this->dark = true;
        return $this;
    }
   
    public function secondary()
    {
        $this->primary = false;
        $this->secondary = true;
        return $this;
    }
   
    public function positive()
    {
        $this->primary = false;
        $this->positive = true;
        return $this;
    }
   
    public function negative()
    {
        $this->primary = false;
        $this->negative = true;
        return $this;
    }
   
    public function warning()
    {
        $this->primary = false;
        $this->warning = true;
        return $this;
    }
   
    public function info()
    {
        $this->primary = false;
        $this->info = true;
        return $this;
    }

    public function lg()
    {
        $this->lg = true;
        return $this;
    }

    
    public function md()
    {
        $this->md = true;
        return $this;
    }

    
    public function xs()
    {
        $this->xs = true;
        return $this;
    }
    
    public function rounded()
    {
        $this->rounded = true;
        return $this;
    }
    
    public function squared()
    {
        $this->squared = true;
        return $this;
    }
    
    public function bordered()
    {
        $this->bordered = true;
        return $this;
    }
    
    public function flat()
    {
        $this->flat = true;
        return $this;
    }
    
    public function spinner($spinner = true)
    {
        $this->spinner = $spinner;
        return $this;
    }
    
    public function rightIcon($rightIcon)
    {
        $this->rightIcon = $rightIcon;
        return $this;
    }
    
    public function size($size)
    {
        $this->size = $size;
        return $this;
    }
    
    public function color($color)
    {
        $this->color = $color;
        return $this;
    }

}