<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Theme;

use Tall\Theme\Components\FilterDatePicker;

class Tailwind extends ThemeBase
{
    
    public string $name = 'tailwind';

    public static function paginationTheme(): string
    {
        return 'tailwind';
    }

    public function filterDatePicker(): FilterDatePicker
    {
        return Theme::filterDatePicker()
            ->input('appearance-none flatpickr flatpickr-input block mt-1 mb-1 bg-white-200 border border-gray-300 text-gray-700 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 w-full active dark:bg-gray-500 dark:text-gray-200 dark:placeholder-gray-200 dark:border-gray-500')
            ->divNotInline('pt-2 p-2')
            ->divInline('');
    }

}