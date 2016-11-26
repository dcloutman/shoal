<?php
/**
 * \Shoal\Net\Json\AjaxResponse
 * @author David Cloutman
 * @package \Shoal\Net\Json
 * @license MIT
 */

namespace Shoal\Net\Json;

/**
 * A base response class.
 */
class AjaxResponse {
	/**
	 * @param string The value set by subclasses of this class. This property is public so that it is exposed when JSON encoded. Use class methods of inheriting classes to modify its contents.
	 * @internal
	 */
	public $status = null;

	/**
	 * @param A human readable message summarizing the response. This property is public so that it is exposed when JSON encoded. Use class methods of inheriting classes to modify its contents.
	 * @internal
	 */
	public $message = '';
}
