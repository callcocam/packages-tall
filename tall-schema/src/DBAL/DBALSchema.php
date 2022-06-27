<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Schema\DBAL;

use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Tall\Schema\ISchema;
use Tall\Schema\Support\AssetNameQuote;

abstract class DBALSchema implements ISchema
{
    use AssetNameQuote;

    protected $dbalSchema;

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function __construct(RegisterColumnType $registerColumnType)
    {
      
        $this->dbalSchema = $this->makeSchemaManager();
   
        $registerColumnType->handle();
      
    }

    /**
     * @inheritDoc
     * @throws \Doctrine\DBAL\Exception
     */
    public function getTableNames(): Collection
    {
        return (new Collection($this->dbalSchema->listTableNames()))
            ->map(function ($table) {
                // The table name may contain quotes.
                // Always trim quotes before set into list.
                if ($this->isIdentifierQuoted($table)) {
                    return $this->trimQuotes($table);
                }
                return $table;
            });
    }

    /**
     * Make a schema manager.
     *
     * @return \Doctrine\DBAL\Schema\AbstractSchemaManager
     * @throws \Doctrine\DBAL\Exception
     */
    private function makeSchemaManager(): AbstractSchemaManager
    {
        $doctrineConnection = DB::getDoctrineConnection();
        if (method_exists($doctrineConnection, 'createSchemaManager')) {
            return $doctrineConnection->createSchemaManager();
        }

        // @codeCoverageIgnoreStart
        return $doctrineConnection->getSchemaManager();
        // @codeCoverageIgnoreEnd
    }
}