<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Editor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tall\Editor\Services\OEmbedService;


class OEmbedController extends Controller
{
    public function show(Request $request, OEmbedService $oembed)
    {
        try {
            return $oembed->parse(
                $request->get('url')
            );
        } catch (\Exception $e) {
            return [];
        }
    }
}