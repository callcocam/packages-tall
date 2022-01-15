<?php
    if (!function_exists('cep'))
    {
        /**
         * @param string $value
         * @return \Tall\Form\Cep\CepResponse
         * @throws Exception
         */
        function cep(string $value): \Tall\Form\Cep\CepResponse
        {
            /** @var $cep */
            $cep = function_exists('app')
                ? app('Cep')
                : new \Tall\Form\Cep\Cep(new \Tall\Form\Cep\CepRequest());
            return $cep->find($value);
        }
    }
    if (!function_exists('endereco'))
    {
        /**
         * @param string $uf
         * @param string $cidade
         * @param string $logradouro
         * @return \Tall\Form\Cep\EnderecoResponse
         * @throws Exception
         */
        function endereco(string $uf, string $cidade, string $logradouro): \Tall\Form\Cep\EnderecoResponse
        {
            /** @var $endereco */
            $endereco = function_exists('app')
                ? app('Endereco')
                : new \Tall\Form\Cep\Endereco(new \Tall\Form\Cep\CepRequest());
            return $endereco->find($uf, $cidade, $logradouro);
        }
    }