<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Form\Fields;

use Tall\Form\Field;

class DatetimePicker extends Field 
{
    protected $type         =	"datetime-picker";
    protected $withoutTips     =	true;//--
    protected $withoutTimezone =	true;//--
    protected $withoutTime     =	true;//--
    protected $interval         =	null;//--
    protected $time_format      =	12;//12|24
    protected $timezone         =	"UTC";
    protected $user_timezone    =	"timezone";
    protected $parse_format     =	"DD-MM-YYYY";//DD-MM-YYYY HH:mm
    protected $display_format   =	"localeFormat";

    public function without_tips(){
        $this->withoutTips = false;
        return $this;
    }

    public function without_timezone(){
        $this->withoutTimezone = false;
        return $this;
    }

    public function without_time(){
        $this->withoutTime = false;
        return $this;
    }
    
    public function interval($interval){
        $this->interval = $interval;
        return $this;
    }
    
    public function time_format($time_format){
        $this->time_format = $time_format;
        return $this;
    }
    
    public function timezone($timezone){
        $this->timezone = $timezone;
        return $this;
    }
    
    public function user_timezone($user_timezone){
        $this->user_timezone = $user_timezone;
        return $this;
    }
    
    public function parse_format($parse_format = 'DD-MM-YYYY HH:mm'){
        $this->parse_format = $parse_format;
        $this->without_time();
        return $this;
    }
    
    public function display_format($display_format){
        $this->display_format = $display_format;
        return $this;
    }

}
