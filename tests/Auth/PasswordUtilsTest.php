<?php
use PHPUnit\Framework\TestCase;
use Shoal\Auth\PasswordUtils;

class PasswordUtilsTest extends TestCase {
    public function setup () {
        $this->badPassword = 'swordfish';
        $this->betterPassword = 'S0mTh1ng!C0mP1e%';
    }

    public function testGenerateSalt () {
        $testSalt = PasswordUtils::generateSalt();
        $this->assertNotEmpty($testSalt);

        $longerSalt = PasswordUtils::generateSalt(PasswordUtils::ADVISED_MIN_SALT_LENGTH + 1);
        $this->assertNotEmpty($testSalt);
        $this->assertNotEquals($testSalt, $longerSalt);

        return [
            'userSalt' => $testSalt,
            'applicationSalt' => $longerSalt,
        ];
    }

    /**
     * @depends testGenerateSalt
     */
    public function testOrderSalts ($data) {
        $this->assertTrue(true);

        /*
        echo "\n";
        echo "p0 " . sha1('p0') . ' ' . substr(sha1('p0'), -1 , 1) . ' ' . hexdec(substr(sha1('p0'), -1 , 1)) % 2 . "\n";
        echo "p1 " . sha1('p1') . ' ' . substr(sha1('p1'), -1 , 1) . ' ' . hexdec(substr(sha1('p1'), -1 , 1)) % 2 . "\n";
        
        echo "\n";
        echo "u0 " . sha1('u0') . ' ' . substr(sha1('u0'), -1 , 1) . ' ' . hexdec(substr(sha1('u0'), -1 , 1)) % 2 . "\n";
        echo "u2 " . sha1('u2') . ' ' . substr(sha1('u2'), -1 , 1) . ' ' . hexdec(substr(sha1('u2'), -1 , 1)) % 2 . "\n";
        echo "u4 " . sha1('u4') . ' ' . substr(sha1('u4'), -1 , 1) . ' ' . hexdec(substr(sha1('u4'), -1 , 1)) % 2 . "\n";
        echo "u5 " . sha1('u5') . ' ' . substr(sha1('u5'), -1 , 1) . ' ' . hexdec(substr(sha1('u5'), -1 , 1)) % 2 . "\n";
        echo "u9 " . sha1('u9') . ' ' . substr(sha1('u9'), -1 , 1) . ' ' . hexdec(substr(sha1('u9'), -1 , 1)) % 2 . "\n";

        echo "p0 -> 1\n";
        echo "u0p0 " . sha1('u0p0') . ' ' . substr(sha1('u0p0'), -1 , 1) . ' ' . hexdec(substr(sha1('u0p0'), -1 , 1)) % 2 . "\n";
        echo "u4p0 " . sha1('u4p0') . ' ' . substr(sha1('u4p0'), -1 , 1) . ' ' . hexdec(substr(sha1('u4p0'), -1 , 1)) % 2 . "\n";
        echo "u5p0 " . sha1('u5p0') . ' ' . substr(sha1('u5p0'), -1 , 1) . ' ' . hexdec(substr(sha1('u5p0'), -1 , 1)) % 2 . "\n";
        echo "u9p0 " . sha1('u9p0') . ' ' . substr(sha1('u9p0'), -1 , 1) . ' ' . hexdec(substr(sha1('u9p0'), -1 , 1)) % 2 . "\n";

        echo "p1 -> 0\n";
        echo "p1u0 " . sha1('p1u0') . ' ' . substr(sha1('p1u0'), -1 , 1) . ' ' . hexdec(substr(sha1('p1u0'), -1 , 1)) % 2 . "\n";
        echo "p1u2 " . sha1('p1u2') . ' ' . substr(sha1('p1u2'), -1 , 1) . ' ' . hexdec(substr(sha1('p1u2'), -1 , 1)) % 2 . "\n";
        echo "p1u5 " . sha1('p1u5') . ' ' . substr(sha1('p1u5'), -1 , 1) . ' ' . hexdec(substr(sha1('p1u5'), -1 , 1)) % 2 . "\n";
        echo "p1u9 " . sha1('p1u9') . ' ' . substr(sha1('p1u9'), -1 , 1) . ' ' . hexdec(substr(sha1('p1u9'), -1 , 1)) % 2 . "\n";
        */

        // Generate all possible order of password, user salt, and application salt.
        // p  u  up
        // 1  1  1
        // p0 u9 u9p0 a1u9p0
        $this->assertEquals('a1u9p0', TestUtils\Auth\PasswordUtilsSubclass::orderSalts('p0', 'u9', 'a1'));
        // 1  0  1
        // p0 u0 u0p0 a1u0p0
        $this->assertEquals('a1u0p0', TestUtils\Auth\PasswordUtilsSubclass::orderSalts('p0', 'u0', 'a1'));
        // 1  1  0 
        // p0 u5 u5p0 u5p0a1
        $this->assertEquals('u5p0a1', TestUtils\Auth\PasswordUtilsSubclass::orderSalts('p0', 'u5', 'a1'));
        // 1  0  0
        // p0 u4 u4p0 u4p0a1
        $this->assertEquals('u4p0a1', TestUtils\Auth\PasswordUtilsSubclass::orderSalts('p0', 'u4', 'a1'));

        // p  u  pu
        // 0  1  1
        // p1 u9 p1u9 a1p1u9
        $this->assertEquals('a1p1u9', TestUtils\Auth\PasswordUtilsSubclass::orderSalts('p1', 'u9', 'a1'));
        // 0  0  1
        // p1 u0 p1u0 a1p1u0
        $this->assertEquals('a1p1u0', TestUtils\Auth\PasswordUtilsSubclass::orderSalts('p1', 'u0', 'a1'));
        // 0  1  0
        // p1 u5 p1u5 p1u5a1
        $this->assertEquals('p1u5a1', TestUtils\Auth\PasswordUtilsSubclass::orderSalts('p1', 'u5', 'a1'));
        // 0  0  0
        // p1 u2 p1u2 p1u2a1
        $this->assertEquals('p1u2a1', TestUtils\Auth\PasswordUtilsSubclass::orderSalts('p1', 'u2', 'a1'));


        return $data;
    }

    /**
     * @depends testOrderSalts
     *
     */
    public function testGeneratePasswordHash ($data) {
        // Sanity check.
        $this->assertNotEquals($this->badPassword, $this->betterPassword);

        $badHash = PasswordUtils::generatePasswordHash($this->badPassword, $data['userSalt'], $data['applicationSalt']);
        $this->assertNotEmpty($badHash);

        $betterHash = PasswordUtils::generatePasswordHash($this->betterPassword, $data['userSalt'], $data['applicationSalt']);
        $this->assertNotEmpty($betterHash);

        // Different passwords using the same salts should produce different hashes. (There is a minute, but non-zero chance that
        // this is not true as random salts may very rarely produce an identical hash for different passwords. If this assertion
        // fails, rerun the test.)
        if ($badHash === $betterHash) {
            echo "\nWow! Identical hashes for different passwords.\n\n Regenerating salts and hashes and trying again...\n";
            $data['userSalt'] = PasswordUtils::generateSalt();
            $data['applicationSalt'] = PasswordUtils::generateSalt(PasswordUtils::ADVISED_MIN_SALT_LENGTH + 1);

            $badHash = PasswordUtils::generatePasswordHash($this->badPassword, $data['userSalt'], $data['applicationSalt']);
            $this->assertNotEmpty($badHash);

            $betterHash = PasswordUtils::generatePasswordHash($this->betterPassword, $data['userSalt'], $data['applicationSalt']);
            $this->assertNotEmpty($betterHash);

        }

        $this->assertNotEquals($badHash, $betterHash);

        $data['badHash'] = $badHash;
        $data['betterHash'] = $betterHash;

        //sleep(rand(1, 3));

        return $data;
     }

     /**
      * @depends testGeneratePasswordHash
      */
     public function testIsPasswordValid ($data) {
        $this->assertNotEmpty($this->betterPassword);
        $this->assertNotEmpty($data['betterHash']);
        $this->assertNotEmpty($this->badPassword);
        $this->assertNotEmpty($data['badHash']);
        $this->assertNotEmpty($data['userSalt']);
        $this->assertNotEmpty($data['applicationSalt']);


        // Represents a login with the correct password and salts.
        $this->assertTrue(PasswordUtils::isPasswordValid($this->betterPassword, $data['betterHash'], $data['userSalt'], $data['applicationSalt']));

        // A login with the incorrect password and the correct salts.
        $this->assertFalse(PasswordUtils::isPasswordValid($this->badPassword, $data['betterHash'], $data['userSalt'], $data['applicationSalt']));

        // Logins with the incorrect passwords and the incorect salts. Errors will be throw because the bad salts are too short.
        $this->assertFalse(PasswordUtils::isPasswordValid($this->betterPassword, 'abcdefghijklmnop', $data['userSalt'], $data['applicationSalt']));
        $this->assertFalse(PasswordUtils::isPasswordValid($this->betterPassword, $data['betterHash'], 'abcdefghijklmnop', $data['applicationSalt']));
        $this->assertFalse(PasswordUtils::isPasswordValid($this->betterPassword, $data['betterHash'], $data['userSalt'], 'abcdefghijklmnop'));
        $this->assertFalse(PasswordUtils::isPasswordValid($this->betterPassword, $data['betterHash'], '', ''));


        return $data;
     }
}


