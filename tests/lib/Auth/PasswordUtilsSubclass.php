<?php
namespace TestUtils\Auth;
use Shoal\Auth\PasswordUtils;

class PasswordUtilsSubclass extends PasswordUtils {
    static public function orderSalts ($password, $userSalt, $applicationSalt) {
        return parent::orderSalts($password, $userSalt, $applicationSalt);
    }
    
}
