<?php
declare(strict_types=1);

namespace BudgetcontrolLibs\Crypt\Service;

use BudgetcontrolLibs\Crypt\Exceptions\MissingKeyException;

/**
 * CryptableService class provides encryption and decryption services.
 *
 * @package LibsCryptable
 * @subpackage Service
 */
class CryptableService
{
    private string $key;
    private string $cipher;

    /**
     * CryptableService constructor.
     *
     * @param string $key The encryption key to be used by the service.
     */
    public function __construct(string $key, string $cipher = 'aes-256-cbc')
    {
        $this->key = $key;
        $this->cipher = $cipher;
    }

    /**
     * Generates an initialization vector (IV) based on the given text.
     *
     * @param string $text The text used to generate the IV.
     * @return string The generated IV.
     */
    private function generateIv($text) {
        return substr(md5($text), 0, 16);
    }
    
    /**
     * Encrypts the given text.
     *
     * @param string $text The text to be encrypted.
     * @return string The encrypted text.
     */
    public function encrypt($text) {

        if(!isset($this->key)) {
            throw new MissingKeyException();
        }

        $key = $this->key;
        $iv = $this->generateIv($key);
        $encrypted = openssl_encrypt($text, $this->cipher, base64_decode(substr($key, 7)), 0, $iv);
        return $encrypted;
    }
    
    /**
     * Decrypts the given encrypted data.
     *
     * @param string $encrypted The encrypted data to decrypt.
     * @return string The decrypted data.
     */
    public function decrypt($encrypted) {

        if(!isset($this->key)) {
            throw new MissingKeyException();
        }

        $key = $this->key;
        $iv = $this->generateIv($key);
        $decrypted = openssl_decrypt($encrypted, $this->cipher, base64_decode(substr($key, 7)), 0, $iv);
        return $decrypted;
    }
}