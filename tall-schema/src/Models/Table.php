<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Schema\Models;

use Illuminate\Support\Collection;

interface Table extends Model
{
    /**
     * Get the table name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get a list of columns.
     *
     * @return \Illuminate\Support\Collection<\App\Schema\Models\Column>
     */
    public function getColumns(): Collection;

    /**
     * Get a list of indexes.
     *
     * @return \Illuminate\Support\Collection<\App\Schema\Models\Index>
     */
    public function getIndexes(): Collection;

    /**
     * Get the table collation.
     *
     * @return string|null
     */
    public function getCollation(): ?string;
}