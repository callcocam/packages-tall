<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Schema\Models\Enum\Migrations\Method;

use Tall\Schema\MyCLabs\Enum;
/**
 * Predefined index types of the framework.
 *
 * @see https://laravel.com/docs/master/migrations#available-index-types
 *
 * @method static self FULLTEXT()
 * @method static self FULLTEXT_CHAIN()
 * @method static self INDEX()
 * @method static self PRIMARY()
 * @method static self SPATIAL_INDEX()
 * @method static self UNIQUE()
 */
final class IndexType extends Enum
{
    private const FULLTEXT       = 'fullText';
    private const FULLTEXT_CHAIN = 'fulltext'; // Use lowercase.
    private const INDEX          = 'index';
    private const PRIMARY        = 'primary';
    private const SPATIAL_INDEX  = 'spatialIndex';
    private const UNIQUE         = 'unique';
}