<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Editor\Blocks;

class ContentRenderer
{
    /**
     * @var BlockParser
     */
    private $parser;

    public function __construct(BlockParser $parser)
    {
        $this->parser = $parser;
    }

    public function render(string $content): string
    {
        $output = '';
        $blocks = $this->parser->parse($content);

        foreach ($blocks as $block) {
            $output .= $block->render();
        }

        return $output;
    }
}