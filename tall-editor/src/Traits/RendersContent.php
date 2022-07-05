<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Editor\Traits;


use Tall\Editor\Blocks\ContentRenderer;

use function app;

trait RendersContent
{
    protected $contentColumn = 'content';

    public function render(string $column = null): string
    {
        $column = $column ?: $this->contentColumn;
        $renderer = app(ContentRenderer::class);
        $content = data_get($this->description,$column);
        return $renderer->render(is_string($content) ? $content : '');
    }
}
