<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Schema\Models;

interface View extends Model
{
    /**
     * Get the view name, always unquoted.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get the view name, always quoted.
     *
     * @return string
     */
    public function getQuotedName(): string;

    /**
     * Get the create view SQL.
     *
     * @return string
     */
    public function getCreateViewSql(): string;
}
