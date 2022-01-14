<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use function PHPUnit\Framework\matches;

class MakeForm extends Command
{
   
    protected $description = 'Make a TAll-form component for a model';

    protected function getStubs($file): string
    {
        if (is_string($this->option('template')) && empty($this->option('template')) === false) {
            return File::get(base_path($this->option('template')));
        }
        $stub = match ($file) {
            'create' => File::get(__DIR__ . '/../../resources/stubs/create-component.stub'),
            'edit' => File::get(__DIR__ . '/../../resources/stubs/edit-component.stub'),
            'modal' => File::get(__DIR__ . '/../../resources/stubs/modal-component.stub')
        };
        return $stub;
    }

    protected function modelExist($modelName, $modelLastName){
        if(!class_exists($modelName)){
            $model = (bool) $this->confirm('A model <comment>' . $modelName . '</comment> não existe. Você gostaria de criar?');

            if ($model) {
                $this->call('make:model',[
                    'name'=>$modelLastName,
                    '-m' => true,
                    '-f' => true,
                    '-s' => true,
                ]);
            }
        }
    }
}
