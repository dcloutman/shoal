<?php
/**
 * \Shoal\Security\Nonce
 * @author David Cloutman
 * @package \Shoal\Security
 * @license MIT
 *
 * Provides a mechanism for creating and outputting nonces.
 *
 */
namespace Shoal\Security;
require_once( __DIR__ . '/../Crypt/Urandom.php');

use Shoal\Crypt\Urandom;

class Nonce {
    protected static $instance = null;

    protected $cookieNamePrefix = 'shoal';
    protected $nonce = null;


    public function sendNonceHeader () {
        $_COOKIE["{$this->cookieNamePrefix}_nonce"] = $this->generateValue();
    }

    public function getNonce () {
        return $this->nonce;
    }

    public function generateNonce ($size = 128) {
        $urandom = Urandom::getInstance();
        $this->nonce = $urandom->getRandomBase64String($size);
	    return $this->nonce;
    }

    private function __construct ($cookieNamePrefix = null) {
        if (null !== $cookieNamePrefix) {
            $this->cookieNamePrefix = $cookieNamePrefix;
        }
        $this->generateNonce();
    }

    public function getInstance () {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __clone () {}

}

$nonce1 = Nonce::getInstance();
echo $nonce1->generateNonce() . "\n";
echo $nonce1->getNonce() . "\n";
$nonce2 = Nonce::getInstance();
echo $nonce2->generateNonce(32) . "\n";
echo $nonce1->getNonce() . "\n";
