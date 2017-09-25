<?php
/**
 * \Shoal\Net\Json\AjaxError
 * @author David Cloutman
 * @package \Shoal\Net\Json
 * @license MIT
 */

namespace Shoal\Net\Json;

/**
 * An error reporting class that serializes to JSON by default.
 */
class AjaxError extends AjaxResponse {
    /**
     * @var array Error messages indexed by a field name. The values of each member should communicate validation errors to the client. This property is public so that it is exposed when JSON encoded. Use class methods to modify its contents.
     * @internal
     */
    public $fieldErrors = []; //

    /**
     * Create a new AjaxError object.
     * @param string $message A human readable message that explains the error. Consider using field errors for more specificity when flagging fields that failed validation.
     */
    function __construct ( $message = '' ) {
        $this->status = 'error';
        $this->message = $message;
    }

    /**
     * Change the value of the main, human readable message, in a non-surprising way.
     * @param string $message A human readable message that explains the error.
     */
    public function setMessage( $message = '' ) {
        $this->message = $message;
    }

    /**
     * Associate an error message with a particular field name. Useful in providing field specific error messages for the end user.
     * @param string $fieldName Should match the name of the parameter passed in the AJAX call.
     * @param string $errorMessage A human readable message that explains the error.
     * @return AjaxError Reference to instance.
     */
    public function addFieldError( $fieldName, $errorMessage ) {
        $this->fieldErrors[$fieldName] = $errorMessage;
        return $this;
    }

    /**
     * Merge an array of field errors with the current set of field errors. New errors overwrite the old.
     * @param array $fieldErrorsArr An associative array in the format of fieldName => error.
     * @return AjaxError Reference to instance.
     */
    public function mergeFieldErrors( $fieldErrorsArr ) {
        if ( is_array($fieldErrorsArr) ) {
            $this->fieldErrors = array_merge( $this->fieldErrors, $fieldErrorsArr );
        }
        else {
            throw new Exception( 'Attempted to merge non-array into field errors in AjaxError.' );
        }

        return $this;
    }

    /**
     * Use JSON encoding as a default string representation.
     * @return string
     */
    public function __toString () {
        return json_encode( $this );
    }
}
