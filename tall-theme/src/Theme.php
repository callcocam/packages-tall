<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Theme;

use Illuminate\Support\Facades\Facade;

class Theme extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'theme';
    }
}