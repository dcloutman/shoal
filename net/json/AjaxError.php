<?php
namespace lampfire\net\json;

/** An error reporting class that serializes to JSON by default.
 */
class AjaxError extends AjaxResponse {
	public $field_errors = array(); // Error messages indexed by the field's name.

	/** Create a new AjaxError object.
	 *  @param string $message A general explanation of what went wrong. Consider using field errors for more specificity.
	 */
	function __construct ( $message = '' ) {
		$this->status = 'error';
		$this->message = $message;
	}

	/** Change the value of the main, human readable message, in a non-surprising way.
	 *  @param string $message.
	 */
	public function set_message( $message = '' ) {
		$this->message = $message;
	}

	/** Associate an error message with a particular field name. Useful in providing field specific error messages for the end user.
	 *  @param string $field_name Should match the name of the parameter passed in the AJAX call.
	 *  @param string $error_message An explanation of the error.
	 *  @return AjaxError Reference to instance.
	 */
	public function add_field_error( $field_name, $error_message ) {
		$this->field_errors[$field_name] = $error_message;
		return $this;
	}

	/** Merge an array of field errors with the current set of field errors. New errors overwrite the old.
	 *	@param array $field_errors_arr An associative array in the format of field_name => error.
	 *  @return AjaxError Reference to instance.
	 */
	public function merge_field_errors( $field_errors_arr ) {
		if ( is_array($field_errors_arr) ) {
			$this->field_errors = array_merge( $this->field_errors, $field_errors_arr );
		}
		else {
			throw new Exception( 'Attempted to merge non-array into field errors in AjaxError.' );
		}

		return $this;
	}

	/** Use JSON encoding as a default string representation.
	 *  @return string
	 */
	public function __toString () {
		return json_encode( $this );
	}
}
