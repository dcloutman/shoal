<?php
/**
 * \Shoal\Exceptions\ExpectedMemberMissingException
 * @author David Cloutman
 * @package \Shoal\Exceptions
 * @license MIT
 *
 * An exception to be thrown when an array or object is missing an expected member.
 */

namespace Shoal\Exceptions;

/**
 * Extends PHP's \Exception class.
 */
class ExpectedMemberMissingException extends \Exception {
    /**
     * Create an instance of the exception.
     * @param string $message
     * @param integer $code
     * @param \Exception $previous
     */
    public function __construct($message = null, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
