<?php
namespace Shoal\Slim\Net\Json;

/**
 * Static method userful for using JSON in a Slim application.
 */
class Utilities {

	/** Configure the Slim->response object for JSON content.
	 *  @param \Slim\Slim $app An instance of the Slim application.
	 *  @param integer $statusCode A valid HTTP status code.
	 *  @
	 */
	public static function configureJsonResponse ( \Slim\Slim $app, $statusCode, \Shoal\Net\Json\AjaxResponse $json ) {
		$app->response->setStatus( $statusCode );
		$app->response->headers->set( 'Content-Type', 'application/json' );
		$app->response->setBody( $json );
	}

}
