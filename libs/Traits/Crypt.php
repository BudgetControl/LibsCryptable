<?php
declare(strict_types=1);

namespace BudgetcontrolLibs\Crypt\Traits;

use BudgetcontrolLibs\Crypt\Service\CryptableService;

trait Crypt {

    protected string $key;

    /**
     * Encrypts the given text.
     *
     * @param string $text The text to be encrypted.
     * @return string The encrypted text.
     */
    public function encrypt($text) {
        $service = new CryptableService($this->key);
        return $service->encrypt($text);
    }

    /**
     * Decrypts the given encrypted data.
     *
     * @param string $encrypted The encrypted data to decrypt.
     * @return string The decrypted data.
     */
    public function decrypt($encrypted) {
        $service = new CryptableService($this->key);
        return $service->decrypt($encrypted);
    }

}