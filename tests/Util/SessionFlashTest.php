<?php
use PHPUnit\Framework\TestCase;
use Shoal\Util\SessionFlash;

class SessionFlashTest extends TestCase {
    public function setup () {
        // The $_SESSION superglobal may not be set when PHP is run from the command line. It if doesn't exist,
        // create it.
        if (!isset($_SESSION)) {
            global $_SESSION;
            $_SESSION = [];
        }

        $this->flash = new SessionFlash();
    }

    public function testSession () {
        $this->assertTrue(isset($_SESSION));
    }

    /**
     * @depends testSession
     */
    public function testPrefix () {
        $this->assertEquals('shoal', SessionFlash::getSessionFlashPrefix());
        SessionFlash::setSessionFlashPrefix('shoal-test');
        $this->assertEquals('shoal-test', SessionFlash::getSessionFlashPrefix());
    }
}
