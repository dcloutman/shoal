<?php
namespace \Lampfire\Shoal\Slim\Net\Json;

class Utilities {

	/** Configure the Slim->response object for JSON content.
	 *  @param \Slim\Slim $app An instance of the Slim application.
	 *  @param integer $status_code A valid HTTP status code.
	 *  @
	 */
	public static function configure_json_response ( \Slim\Slim $app, $status_code, AjaxResponse $json ) {
		$app->response->setStatus( $status_code );
		$app->response->headers->set( 'Content-Type', 'application/json' );
		$app->response->setBody( $json );
	}

}
