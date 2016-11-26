<?php
/**
 * \Shoal\Auth\PasswordAuthenticationUtils
 * @author David Cloutman
 * @package \Shoal\Auth
 * @license MIT
 */

namespace Shoal\Auth;

/**
 * A utility class for simple but secure authentication routines.
 */
class PasswordAuthenticationUtils {
	/**
	 * Determine if a user supplied password matches the sha1 hash of the given salts.
	 * @param string $supplied_password The passwords supplied by the agent attempting to gain access to the system.
	 * @param string $password_hash The password hash stored for the user.
	 * @param string $user_salt A user-specific salt stored with the password hash.
	 * @param string $application_salt An application provided salt, typically used for all users.
	 * @return string A sha1 hash
	 */
	static public function is_password_valid ($supplied_password, $password_hash, $user_salt, $application_salt) {
		if (self::generatePasswordHash($supplied_password, $user_salt, $application_salt) == $password_hash) {
			return true;
		}

		return false;
	}

	/**
	 * Concatenates a user supplied password with the application salt and the user's salt and returns a sha1 hash value.
	 * @param string $password
	 * @param string $user_salt
	 * @param string $application_salt
	 * @return string A sha1 hash
	 */
	static public function generate_password_hash ($password, $user_salt, $application_salt) {
		return sha1($user_salt, $password, $application_salt);
	}

	/**
	 * Generates a random base64 string from a random binary string.
	 * @param integer $stream_length The length of the binary stream that will be encoded.
	 * @return string A base64 encoded random binary stream.
	 */
	static public function generate_salt ($stream_length = 4096) {
		$urandom = \Shoal\Crypt\Urandom::get_instance();
		return $urandom->get_random_base64_string($stream_length);
	}
}
