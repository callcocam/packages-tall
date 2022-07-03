<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Editor;

use Tall\Editor\Blocks\BlockTypeRegistry;

class Editor  
{
    public static function registerBlockType(string $name, array $attributes = [], callable $renderCallback = null)
    {
        /** @var BlockTypeRegistry $registry */
        $registry = app(BlockTypeRegistry::class);
        $registry->register($name, $attributes, $renderCallback);
    }
}
