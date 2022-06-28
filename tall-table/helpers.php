<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

use Illuminate\Support\Facades\Cache;

if (!function_exists('lista_estados')) {
    
    function lista_estados($sigla=null){
        return [
           "AC"=>"Acre",
           "AL"=>"Alagoas",
           "AP"=>"Amapá",
           "AM"=>"Amazonas",
           "BA"=>"Bahia",
           "CE"=>"Ceará",
           "ES"=>"Espírito Santo",
           "GO"=>"Goiás",
           "MA"=>"Maranhão",
           "MT"=>"Mato Grosso",
           "MS"=>"Mato Grosso do Sul",
           "MG"=>"Minas Gerais",
           "PA"=>"Pará",
           "PB"=>"Paraíba",
           "PR"=>"Paraná",
           "PE"=>"Pernambuco",
           "PI"=>"Piauí",
           "RJ"=>"Rio de Janeiro",
           "RN"=>"Rio Grande do Norte",
           "RS"=>"Rio Grande do Sul",
           "RO"=>"Rondônia",
           "RR"=>"Roraima",
           "SC"=>"Santa Catarina",
           "TO"=>"São Paulo",
           "SE"=>"Sergipe",
           "DF"=>"Distrito Federal"
        ];
    }
}

if(!function_exists("include_table")){

    function include_table($view)
    {
        if (function_exists('theme_include_table')) {    
            return theme_include_table($view);
        }
       return "tall-table::includes.{$view}";
    }
}

if (!function_exists('lv_includes')) {
    
    function lv_includes($component){
        // if (function_exists('theme_lv_includes')) {    
        //     return theme_lv_includes($component);
        // }
        return sprintf("includes.%s-component", $component);
    }
}

if (!function_exists('_validateInputTextOptions')) {
    function _validateInputTextOptions(array $filter, string $field): bool
    {
        return in_array(
            strtolower(\Arr::get($filter, sprintf('input_text.%s.key', $field))),
            ['is', 'is_not', 'contains', 'contains_not', 'starts_with', 'ends_with', 'is_empty', 'is_not_empty', 'is_null', 'is_not_null', 'is_blank', 'is_not_blank']
        );
    }
}


if (!function_exists('clients')) {
    
    function clients(){
        return \App\Models\Auth\Acl\Role::query()->where('slug', 'client')->first();
    }
}

if (!function_exists('corretor')) {
    
    function corretor(){
        return \App\Models\Auth\Acl\Role::query()->where('slug', 'corretor')->first();
    }
}

if (!function_exists('published')) {
    
    function published($status="published"){
        if($published = Cache::remember("60", "{$status}_", function() use($status){
            return \Tall\Form\Models\Status::where('slug', $status)->first();
        })){
            return ['status_id'=>$published->id];
           }
            return [];
    }
}


if (!function_exists('draft')) {
    
    function draft($status="draft"){
        if($draft = Cache::remember("60", "{$status}_", function() use($status){
            return \Tall\Form\Models\Status::where('slug', $status)->first();
        })){
            return ['status_id'=>$draft->id];
           }
        return [];
    }
}


if (!function_exists('status')) {
    
    function status($status="published", $slug = null){
      if($statuses = \Tall\Form\Models\Status::where('slug', $status)->first()){
        if($slug)
         return data_get($statuses, $slug);

        return $statuses->id;
      }
      return data_get(draft(), 'status_id', null);
    }
}

if(!function_exists('date_carbom_format')){

    function date_carbom_format($date, $format="d/m/Y H:i:s"){

        $date = explode(" ", str_replace(["-","/",":","T"]," ",$date));

        if(!isset($date[0])){
            $date[0]= null;
        }
        if(!isset($date[1])){
            $date[1]= null;
        }
        if(!isset($date[2])){
            $date[2]= null;
        }
        if(!isset($date[3])){
            $date[3]= null;
        }
        if(!isset($date[4])){
            $date[4]= null;
        }
        if(!isset($date[5])){
            $date[5]= null;
        }
        list($y,$m,$d,$h,$i,$s) = $date;

        //$carbon = \Carbon\Carbon::now();
        $carbon = \Illuminate\Support\Facades\Date::now();
        $carbon->setLocale('pt_BR');
        if(strlen($date[0]) == 4){
          // echo  $carbon->create($y,$m,$d,$h,$i,$s)->toDateTimeLocalString().PHP_EOL;
         //  echo  $carbon->create($y,$m,$d,$h,$i,$s)->toDayDateTimeString().PHP_EOL;
         
            return $carbon->create($y,$m,$d,$h,$i,$s);

        }
        if($y && $m && $d ){
            return $carbon->create($d,$m,$y,$h,$i,$s);
        }
        return $carbon->create(null,null,null,null,null,null);

    }
}



if ( ! function_exists('form_w'))
{
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function form_w($post) {
        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $post); //remove os pontos e substitui a virgula pelo ponto
        return $valor; //retorna o valor formatado para gravar no banco
    }
}

if ( ! function_exists('form_read'))
{
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function form_read($post) {
        if(is_numeric($post)):
            return @number_format($post,2, ",", "."  );
        endif;
        return $post;
    }
}

if ( ! function_exists('Calcular'))
{
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function Calcular($v1,$v2,$op) {
        $v1 = str_replace ( ".", "", $v1);
        $v1 = str_replace ( ",", ".", $v1);
        $v2 = str_replace ( ".", "",$v2 );
        $v2 = str_replace ( ",", ".",$v2);
        switch ($op) {
            case "+":
                $r = $v1 + $v2;
                break;
            case "-":
                $r = $v1 - $v2;
                break;
            case "*":
                $r = $v1 * $v2;
                break;
            case "%":
                $bs = $v1 / 100;
                $j = $v2 * $bs;
                $r = $v1 + $j;
                break;
            case "/":
                @$r = 0;
                if($v1>0 && $v2>0){
                    @$r = @$v1 / $v2;
                }
                break;
            case "tj":
                $bs = $v1 / 100;
                $j = $v2 * $bs;
                $r = $j;
                break;
            default :
                $r = $v1;
                break;
        }
        $ret = @number_format ( $r, 2, ",", "." );
        return $ret;
    }
}