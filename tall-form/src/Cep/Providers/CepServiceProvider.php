<?php 
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Form\Cep\Providers;

use Tall\Form\Cep\Cep;
use Tall\Form\Cep\CepRequest;
use Tall\Form\Cep\Endereco;
use Illuminate\Support\ServiceProvider;

class CepServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('CepRequest', function()
        {
            return new CepRequest();
        });

        $this->app->singleton('Cep', function($app)
        {
            return new Cep($app['CepRequest']);
        });

        $this->app->singleton('Endereco', function($app)
        {
            return new Endereco($app['CepRequest']);
        });
    }

    public function boot()
    {

        include __DIR__."/../Helpers/cep_helper.php";
        include __DIR__."/../Helpers/uf_helper.php";
    }
}