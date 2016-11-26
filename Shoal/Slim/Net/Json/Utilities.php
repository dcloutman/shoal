<?php
/**
 * \Shoal\Slim\Net\Json
 * @author David Cloutman
 * @package \Shoal\Slim\Net
 * @license MIT
 */

namespace Shoal\Slim\Net\Json;

/**
 * A static class with methods userful for using JSON in a Slim application.
 */
class Utilities {

	/**
	 * Configure the Slim->response object for JSON content.
	 * @param \Slim\Slim $app An instance of the Slim application.
	 * @param integer $statusCode A valid HTTP status code.
	 * @param \Shoal\Net\Json\AjaxRespon $json A JSON response object.
	 */
	public static function configureJsonResponse ( \Slim\Slim $app, $statusCode, \Shoal\Net\Json\AjaxResponse $json ) {
		$app->response->setStatus( $statusCode );
		$app->response->headers->set( 'Content-Type', 'application/json' );
		$app->response->setBody( $json );
	}

}
