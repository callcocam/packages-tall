<?php
/**
* Editd by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\{Arr, Str};
use function PHPUnit\Framework\matches;

class EditCommand extends MakeForm
{
    protected $signature = 'tall:form-edit
    {--template= : nome para o component de tall-form edit}';

    protected $description = 'Faça um componente edit de TAll FORM EDIT para um modelo';
    protected $formName = 'EditComponent';
     /**
     * @throws Exception
     */
    public function handle(): void
    {
        $folderName       = $this->ask('Qual é o nome da pasta onde será criado seu TALL FORM EDIT (E.g., <comment>Users</comment>)?, Resultado sera <comment>Users/EditComponent</comment>');

        if (!is_string($folderName)) {
            throw new \Exception('Could not parse table name');
        }

        $singularName  = Str::singular($folderName);

        $formName       = sprintf("%s/%s", $folderName, $this->formName);

        $base_path     = $this->ask('Deseja alterar a pasta raiz do component Tall Table (Ex:, <comment>Admin</comment>)?, Resultado sera <comment>Admin/'.$folderName.'/EditComponent</comment>');

        if($base_path){
           $formName = sprintf("%s/%s", $base_path, $formName);
        }

        $formName = str_replace(['.', '\\'], '/', (string) $formName);

        $stub = $this->getStubs('edit');

        $modelName = $this->ask('Insira o caminho do seu modelo (E.g., <comment>App\Models\User ou User</comment>)');
        if (!is_string($modelName)) {
            throw new \Exception('Could not parse table name');
        }
        if(!Str::contains($modelName, "\\")){
            $modelName = sprintf("App\\Models\\%s", $modelName);
        }

        $modelNameArr = [];

        preg_match('/(.*)(\/|\.|\\\\)(.*)/', $formName, $matches);

        if (!is_array($matches)) {
            throw new Exception('Could not parse model name');
        }

        $modelNameArr  = explode('\\', $modelName);
        $modelLastName = Arr::last($modelNameArr);

        if (empty($modelName)) {
            $this->error('Could not create, Model path is missing');
        }
        $this->modelExist($modelName, $modelLastName);

        $componentName   = $formName;
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
       
        $component_name = Str::of($formName)
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
       
        
        $path          = app_path($livewirePath . $formName . '.php');

        $filename  = Str::of($path)->basename();
        $basePath  = Str::of($path)->replace($filename, '');

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

        $createForm = true;

        if (File::exists($path)) {
            $confirmation = (bool) $this->confirm('Parece que <comment>' . $formName . '</comment> já existe. Você gostaria de sobrescrever?');

            if ($confirmation === false) {
                $createForm = false;
            }
        }

        if ($createForm && is_string($stub)) {
            File::put($path, $stub);

            $this->info("\n⚡ <comment>" . $filename . '</comment> foi criado com sucesso em [<comment>App/' . $savedAt . '</comment>].');
            $this->info("\n⚡Sua TALL TABLE agora pode ser incluído com o tag: <comment>" . $component_name . "</comment>\n");
            $this->info("\n⚡ou pode ser acessada via: <comment>http://".request()->getHost()."/admin/". $singularName . "/create</comment>\n");
        }

    }

}