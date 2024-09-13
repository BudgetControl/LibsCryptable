<?php
declare(strict_types=1);
namespace BudgetcontrolLibs\Crypt\Exceptions;

use Exception;

class MissingKeyException extends Exception
{
    public function __construct()
    {
        parent::__construct('Encryption key not set.', 500);
    }
}