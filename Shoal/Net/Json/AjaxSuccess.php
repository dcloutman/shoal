<?php
namespace Shoal\Net\Json;

use Shoal\Net\Json\AjaxError;

/** A wrapper class to report successful submissions that serializes to JSON by default.
 */
class AjaxSuccess extends AjaxResponse {
	public $data; // Encapsulate response data here. It will be JSON serialized in the response.

	/** Create a new AjaxSuccess object.
	 *  @param string $message A general success message. This is not meant to store structured data. It should be a human readable string.
	 */
	function __construct ( $message = '' ) {
		$this->status = 'success';
		$this->message = $message;
	}

	/** Set the response data to send to the client. This may be any type, but is most useful for sending structured data such as an array or object.
	 *	@param mixed $data
	 *  @return AjaxSuccess Returns a reference to the object. Supports a fluid interface.
	 */
	public function setData ( $data ) {
		$this->data = $data;

		return $this;
	}

	/** Use JSON encoding as a default string representation.
	 *  @return string
	 */
	public function __toString () {
		$json_value = json_encode( $this );
		if ( false === is_string($json_value) ) {
			// __toString() cannot throw an exception, so this:
			$conversionError = new AjaxError();
			$conversionError->setMessage( 'Could not convert AjaxSuccess instance to JSON encoded string. Data may not be correctly encoded.' );

			$json_value = json_encode( $conversionError );
		}
		return $json_value;
	}
}
