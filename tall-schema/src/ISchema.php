<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Schema;

use Illuminate\Support\Collection;
use Tall\Schema\Models\Table;

interface ISchema
{
    /**
     * Get a list of table names.
     *
     * @return \Illuminate\Support\Collection<string>
     */
    public function getTableNames(): Collection;

    /**
     * Get a table by name.
     *
     * @param  string  $name  Table name.
     * @return \Tall\Schema\Models\Table
     */
    public function getTable(string $name): Table;

    /**
     * Get a list of view names.
     *
     * @return \Illuminate\Support\Collection<string>
     */
    public function getViewNames(): Collection;

    /**
     * Get a list of views.
     *
     * @return \Illuminate\Support\Collection<\Tall\Schema\Models\View>
     */
    public function getViews(): Collection;

    /**
     * Get a list of foreign keys.
     *
     * @param  string  $table
     * @return \Illuminate\Support\Collection<\Tall\Schema\Models\ForeignKey>
     */
    public function getTableForeignKeys(string $table): Collection;
}