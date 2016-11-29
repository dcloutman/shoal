<?php
use PHPUnit\Framework\TestCase;
use Shoal\Ui\Br;

class BrTest extends TestCase {
	public function testToString () {
		$br = new Br();
		$this->assertEquals('<br />', (string) $br);
	}
}
