<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Schema\DBAL\Models;

use Doctrine\DBAL\Schema\Index as DoctrineDBALIndex;
use Tall\Schema\Models\Enum\Migrations\Method\IndexType;
use Tall\Schema\Models\Index;
use Tall\Schema\Support\CheckMigrationMethod;

abstract class DBALIndex implements Index
{
    use CheckMigrationMethod;

    protected $columns;
    protected $name;
    protected $tableName;
    protected $type;

    /**
     * Create an index instance.
     *
     * @param  string  $table
     * @param  \Doctrine\DBAL\Schema\Index  $index
     */
    public function __construct(string $table, DoctrineDBALIndex $index)
    {
        $this->tableName = $table;
        $this->name      = $index->getName();
        $this->columns   = $index->getUnquotedColumns();
        $this->type      = $this->getIndexType($index);

        $this->handle();
    }

    /**
     * Instance extend this abstract may run special handling.
     *
     * @return void
     */
    abstract protected function handle(): void;

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * @inheritDoc
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * @return \Tall\Schema\Models\Enum\Migrations\Method\IndexType
     */
    public function getType(): IndexType
    {
        return $this->type;
    }

    /**
     * Get the index type.
     *
     * @param  \Doctrine\DBAL\Schema\Index  $index
     * @return \Tall\Schema\Models\Enum\Migrations\Method\IndexType
     */
    private function getIndexType(DoctrineDBALIndex $index): IndexType
    {
        if ($index->isPrimary()) {
            return IndexType::PRIMARY();
        }

        if ($index->isUnique()) {
            return IndexType::UNIQUE();
        }

        if ($index->hasFlag('spatial')) {
            return IndexType::SPATIAL_INDEX();
        }

        if ($this->hasFullText() && $index->hasFlag('fulltext')) {
            return IndexType::FULLTEXT();
        }

        return IndexType::INDEX();
    }
}