<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Editor\Http\Controllers;

use Illuminate\Http\Request;
use Tall\Editor\Blocks\Block;

class BlockRendererController
{
    public function show(Request $request) {
        $request->validate([
            'blockName' => ['required', 'string'],
            'attributes' => ['array']
        ]);

        $block = new Block(
            $request->get('blockName'),
            $request->get('attributes', [])
        );

        return ['rendered' => $block->render()];
    }
}