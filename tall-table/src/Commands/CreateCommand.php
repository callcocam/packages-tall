<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Table\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\{File, Log, Schema};
use Illuminate\Support\{Arr, Str};

class CreateCommand extends Command{
    protected $signature = 'tall:table
    {--template= : nome para o component de tall-table}';

    protected $description = 'Make a new tall-table component.';

    protected $tableName = 'ListComponent';

     /**
     * @throws Exception
     */
    public function handle(): void
    {
        $folderName       = $this->ask('Qual é o nome da pasta onde será criado seu TALL TABLE (E.g., <comment>Users</comment>)?, Resultado sera <comment>Users/ListComponent</comment>');

        if (!is_string($folderName)) {
            throw new \Exception('Could not parse table name');
        }

        $singularName  = Str::singular($folderName);

        $reanme     = $this->ask('Deseja alterar o nome padrão (<comment>ListComponent</comment>) Tall Table (Ex:, <comment>'.$folderName.'</comment>)?, Resultado sera <comment>'.$folderName.'/'.$folderName.'Component</comment>');

        if($reanme){
           $this->tableName = sprintf("%sComponent", $reanme);
        }

        $tableName       = sprintf("%s/%s", $folderName, $this->tableName);

        $base_path     = $this->ask('Deseja alterar a pasta raiz do component Tall Table (Ex:, <comment>Admin</comment>)?, Resultado sera <comment>Admin/Users/[List ou UserComponent</comment>');

        if($base_path){
           $tableName = sprintf("%s/%s", $base_path, $tableName);
        }
       
        $tableName = str_replace(['.', '\\'], '/', (string) $tableName);

        $stub = $this->getStubs();

        $modelName      = '';
        $modelLastName  = '';
        $modelName = $this->ask('Insira o caminho do seu modelo (E.g., <comment>App\Models\User ou User</comment>)');
        if (!is_string($modelName)) {
            throw new \Exception('Could not parse table name');
        }
        if(!Str::contains($modelName, "\\")){
            $modelName = sprintf("App\\Models\\%s", $modelName);
        }

       
        $modelNameArr = [];

        preg_match('/(.*)(\/|\.|\\\\)(.*)/', $tableName, $matches);

        if (!is_array($matches)) {
            throw new Exception('Could not parse model name');
        }

        $modelNameArr  = explode('\\', $modelName);
        $modelLastName = Arr::last($modelNameArr);

        if (empty($modelName)) {
            $this->error('Could not create, Model path is missing');
        }
        
        if(!class_exists($modelName)){
            $modelCreate = (bool) $this->confirm('A model <comment>' . $modelName . '</comment> não existe. Você gostaria de criar?');

            if ($modelCreate) {
                $this->call('make:model',[
                    'name'=>$modelLastName,
                    '-m' => true,
                    '-f' => true,
                    '-s' => true,
                ]);
            }
        }

        $componentName   = $tableName;
        $subFolder       = '';

        if (!empty($matches)) {
            $componentName = end($matches);
            array_splice($matches, 2);
            $subFolder = '\\' . str_replace(['.', '/', '\\\\'], '\\', end($matches));
        }
        if (!is_string($componentName)) {
            throw new \Exception('Could not parse component name');
        }

        if (!is_string($subFolder)) {
            throw new \Exception('Could not parse subfolder name');
        }
       
        $component_name = Str::of($tableName)
        ->lower()
        ->kebab()
        ->replace('/', '.')
        ->replace('\\', '.')
        ->replace('table', '-table')
        ->prepend('<livewire:')
        ->append('/>');

        $appPath  = 'App\\';
        $livewirePath  = 'Http/Livewire/';
        $reanmelivewirePath     = $this->ask("Deseja alterar a pata padrão do livewire (<comment>{$livewirePath}</comment>) Tall Table (Ex:, <comment>Tall\Table\Livewire</comment>)?, Resultado sera <comment>Tall/Table/Admin/Users/UserComponent</comment>,\n Obs:você tera de registrar o component manualmente ou criar um helper para fazer isso dinamicamente :)");

        if($reanmelivewirePath){
            $livewirePath = $reanmelivewirePath;
            $appPath  = '';
        }

        $path          = app_path($livewirePath . $tableName . '.php');

        $filename  = Str::of($path)->basename();
        $basePath  = Str::of($path)->replace($filename, '');

        $savedAt   = $livewirePath . $basePath->after($livewirePath);
        
        $savedAt   = $livewirePath . $basePath->after($livewirePath);

        $Namespace = $appPath.str_replace(['.', '/', '\\\\'], '\\', $savedAt);
        
        $Namespace = Str::beforeLast($Namespace, '\\');

        $stub = str_replace('{{ subFolder }}', $subFolder, $stub);
        $stub = str_replace('{{ componentName }}', $componentName, $stub);
        $stub = str_replace('{{ modelName }}', $modelName, $stub);
        $stub = str_replace('{{ componentNamespace }}', $Namespace, $stub);
        $stub = str_replace('{{ modelLastName }}', $modelLastName, $stub);
        $stub = str_replace('{{ modelLowerCase }}', Str::lower($modelLastName), $stub);
        $stub = str_replace('{{ modelKebabCase }}', Str::kebab($modelLastName), $stub);

        File::ensureDirectoryExists($basePath);

        $createTable = true;

        if (File::exists($path)) {
            $confirmation = (bool) $this->confirm('Parece que <comment>' . $tableName . '</comment> já existe. Você gostaria de sobrescrever?');

            if ($confirmation === false) {
                $createTable = false;
            }
        }

        if ($createTable && is_string($stub)) {
            File::put($path, $stub);

            $this->info("\n⚡ <comment>" . $filename . '</comment> foi criado com sucesso em [<comment>App/' . $savedAt . '</comment>].');
            $this->info("\n⚡Sua TALL TABLE agora pode ser incluído com o tag: <comment>" . $component_name . "</comment>\n");
            $this->info("\n⚡ou pode ser acessada via: <comment>http://".request()->getHost()."/admin/". Str::kebab($modelLastName) . "s</comment>\n");
        }
        
    }

    protected function getStubs(): string
    {
        if (is_string($this->option('template')) && empty($this->option('template')) === false) {
            return File::get(base_path($this->option('template')));
        }
        return File::get(__DIR__ . '/../../resources/stubs/list-component.stub');
    }
}
