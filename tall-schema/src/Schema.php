<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Schema;

class Schema 
{
    
    /**
     * Get DB schema by the database connection name.
     *
    * @throws \Exception
     */
    public static function make()
    {
        $driver = \DB::getDriverName();

        if (!$driver) {
            throw new Exception('Failed to find database driver.');
        }

        switch ($driver) {
             case \Tall\Schema\Enum\Driver::MYSQL()->getValue():
                return app(\Tall\Schema\IMySQLSchema::class);
                break;
            default:
                throw new \Exception('The database driver in use is not supported.');
        }
    }

}
