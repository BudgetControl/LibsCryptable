<?php
declare(strict_types=1);

namespace BudgetcontrolLibs\Crypt\Traits;

trait Hash {

    public function hash(string $key): array
    {
        return hash('sha256', $key);
    }

}
