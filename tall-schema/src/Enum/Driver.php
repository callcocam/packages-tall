<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Schema\Enum;

use Tall\Schema\MyCLabs\Enum;

/**
 * Framework DB connection driver name.
 *
 * @method static self MYSQL()
 * @method static self PGSQL()
 * @method static self SQLITE()
 * @method static self SQLSRV()
 */
final class Driver extends Enum
{
    private const MYSQL  = 'mysql';
    private const PGSQL  = 'pgsql';
    private const SQLITE = 'sqlite';
    private const SQLSRV = 'sqlsrv';
}