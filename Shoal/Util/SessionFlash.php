<?php
/**
 * \Shoal\Util\SessionFlash
 * "Flash" messages are messages that are meant to be displayed to a user after an operation, usually writable, has occured. These can
 * be errors, warnings, success confirmatios, or informational messages.
 * @author David Cloutman
 * @package \Shoal\Util
 * @license MIT
 */

namespace Shoal\Util;

/**
 * Wraps flash routines that read and write into $_SESSION into an object.
 */
class SessionFlash {
    /**
     * @var $flashSessionPrefix A unique prefix for flash $_SESSION elements.
     */
    protected static  $flashSessionPrefix = 'shoal';

    /**
     * By default, flash data is stored in $_SESSION['shoal.flash']. This method will change 'shoal', the prefix, to the value passed to $prefix.
     * @param string $prefix
     */
    public static function setSessionFlashPrefix ($prefix) {
        self::$flashSessionPrefix = $prefix;
    }

    /**
     * By default, flash data is stored in $_SESSION['shoal.flash']. This method will change 'shoal', the prefix, to the value passed to $prefix.
     * @return string
     */
    public static function getSessionFlashPrefix () {
        return self::$flashSessionPrefix;
    }

    /**
     * Create a SessionFlash object.
     */
    function __construct () {
        if ( !$this->isSessionFlashSet() ) {
            $this->initializeSesssionFlash();
        }
    }

    /**
     * Add an error to the array of flash errors stored in the session.
     * @param string $message An error message to display to users.
     * @param array $fields Appends the error_fields array stored in the session with the names of fields the application has flagged as invalid.
     */
    public function addError ( $message, $fields = [] ) {
        $_SESSION[self::$flashSessionPrefix . '.flash']['errors'][] = $message;
        foreach ( $fields as $field ) {
            $_SESSION[self::$flashSessionPrefix . '.flash']['error_fields'][] = $field;
        }
    }

    /**
     * Add an error to the array of flash errors stored in the session.
     * @param string $message A warning message to display to users.
     */
    public function addWarning ( $message ) {
        $_SESSION[self::$flashSessionPrefix . '.flash']['warnings'][] = $message;
    }

    /**
     * Add an error to the array of flash errors stored in the session.
     * @param string $message A success message to display to users.
     */
    public function addSuccess ( $message ) {
        $_SESSION[self::$flashSessionPrefix . '.flash']['successes'][] = $message;
    }

    /**
     * Add an information message to the array of flash information messages stored in the session.
     * @param string $message An informational message to display to users.
     */
    public function addInfo ( $message ) {
        $_SESSION[self::$flashSessionPrefix . '.flash']['info'][] = $message;
    }

    /**
     * Returns a copy of the raw nested array structure from within the $_SESSION superglobal used by this library.
     * @return array
     */
    public function getFlash () {
        $returnValue = $_SESSION[self::$flashSessionPrefix . '.flash']; //Makes a copy.
        return $returnValue;
    }

    /**
     * This method wraps calls to the getFlash() and clearFlash() methods.
     * @return array
     */
    public function getAndClearFlash () {
        $returnValue = false;
        if ( $this->isSessionFlashSet() ) {
            $returnValue = $this->getFlash();
        }

        $this->clearFlash();
        return $returnValue;
    }

    /**
     * Has the flash data structure been instantiated in $_SESSION?
     * @internal
     * @return boolean
     */
    private function isSessionFlashSet () {
        return isset( $_SESSION[self::$flashSessionPrefix . '.flash'] );
    }

    /**
     * Remove flash information from the session. This should be called immediately after flash messages are displayed.
     */
    public function clearFlash () {
        unset( $_SESSION[self::$flashSessionPrefix . '.flash'] );
    }

    /**
     * Creates the necessary array structure in the $_SESSION variable.
     * @internal
     */
    private function initializeSesssionFlash () {
        $_SESSION[self::$flashSessionPrefix . '.flash'] = [
            'errors' => [],
            'error_fields' => [],
            'warnings' => [],
            'info' => [],
            'successes' => [],
        ];
    }

}
