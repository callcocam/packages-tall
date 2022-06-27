<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Schema\Models;

use Tall\Schema\Models\Enum\Migrations\Method\IndexType;

interface Index extends Model
{
    /**
     * Get the index name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get the table name.
     *
     * @return string
     */
    public function getTableName(): string;

    /**
     * Get the index column names.
     *
     * @return string[]
     */
    public function getColumns(): array;

    /**
     * Get the index type.
     *
     * @return \App\Schema\Models\Enum\Migrations\Method\IndexType
     */
    public function getType(): IndexType;
}