<?php
use PHPUnit\Framework\TestCase;

class ExpectedIntExceptionTest extends TestCase {
    public $testMessage = '';

    public function setUp () {
        $this->testMessage = 'This is only a test.';
    }

    public function testThrow () {
        try {
            throw new \Shoal\Exceptions\ExpectedIntException($this->testMessage);
        }
        catch (\Shoal\Exceptions\ExpectedIntException $e) {
            $this->assertNotEmpty($e);

            return $e;
        }

        return false;
    }

    /**
     * Ensures parent constructor was called and set the exception message correctly.
     * @depends testThrow
     */
    public function testGetMessage (\Shoal\Exceptions\ExpectedIntException $e) {
        $this->assertEquals($this->testMessage, $e->getMessage());
    }
}
