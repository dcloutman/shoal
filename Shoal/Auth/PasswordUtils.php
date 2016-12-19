<?php
/**
 * \Shoal\Auth\PasswordUtils
 * @author David Cloutman
 * @package \Shoal\Auth
 * @license MIT
 *
 * <p><strong>TL;DR</strong></p>
 * <p>When used as advised, this library wraps PHP's native password hashing functions password_hash() and password_verify()
 * with an additional manual salting mechanism that makes hashes more computationally expensive. The random salt generated
 * by password_hash() is still used as well, so everthing is extra salty.</p>
 *
 * <p><strong>Details</strong></p>
 * <p>The primary purpose of this library is to provide a secure mechanism for storing one-way cryptographic hashes of
 * user passwords. Originally, passwords were hashed as sha1 hashes where the passwords were salted with two long,
 * highly randomized strings. This method is still supported for backwards compatibility, but is not recommended, and
 * will generate messages in the error log when used. It is no longer the default behavior as of version 0.3 of Shoal.</p>
 *
 * <p>Two different salts are used in the manual salting process.</p>
 * <ol>
 *   <li>A salt that is specific to the user. This is typicall stored in a database with other data about the user.</li>
 *   <li>An application salt that is typically placed in some sort of configuration file and is used for all users of the application.</li>
 *</ol>
 * <p>Sha1 hashing has been replaced with calls to PHP's built-in password_hash() function and verification to password_verify().
 * These functions have a built-in random salting mechanism, however this library takes the intrinsic security improvment
 * provided by the native PHP functions, by adding manual salts to the password hashes so that they will be more computationally expensive to
 * generate and results are harder to predict.</p>
 *
 * <p>The generateSalt() method is the advised mechanism for generating salts used by this library as they will have a
 * cryptographic quality of randomness. The class constant ADVISED_MIN_SALT_LENGTH sets the default length of salts and
 * the library will log complaints when a shorter salt is used. It is advised that user salts and application salts be of
 * different lengths. The application will log instances where identical values are passed as user and applications salts.
 * Such occurances are probably, and presumed to be, the result of an error on the part of the programmer using this library.</p>
 */

namespace Shoal\Auth;

/**
 * A utility class for simple but secure authentication routines.
 */
class PasswordUtils {
	const HASH_ALGO_SHA1 = -1;
	const HASH_ALGO_PASSWORD_HASH = 4;
	const ADVISED_MIN_SALT_LENGTH = 4096;


	/**
	 * Determine if a user supplied password matches the sha1 hash of the given salts.
	 * @param string $suppliedPassword The passwords supplied by the agent attempting to gain access to the system.
	 * @param string $passwordHash The password hash stored for the user.
	 * @param string $userSalt A user-specific salt stored with the password hash.
	 * @param string $applicationSalt An application provided salt, typically used for all users.
	 * @param string $hashAlgorithm Defaults to the contant HASH_ALGO_PASSWORD_HASH for all values except HASH_ALGO_SHA1, which may be used for backwards compatibility, but is not advised.
	 * @param boolean $jumbleSha1Salts Pass false for full backwards compatibility for sha1 hashing. Leave set to default value all new development efforts. This parameter is deprecated.
	 * @return boolean True if the supplied password generates a hash identical to the hashed password stored for the user, false if there is no match.
	 */
	static public function isPasswordValid ($suppliedPassword, $passwordHash, $userSalt = '', $applicationSalt = '', $hashAlgorithm = self::HASH_ALGO_PASSWORD_HASH, $jumbleSha1Salts = true) {
		if (strlen($userSalt) < self::ADVISED_MIN_SALT_LENGTH || strlen($applicationSalt) < self::ADVISED_MIN_SALT_LENGTH) {
			error_log('Line ' . __LINE__ . ' in ' . __CLASS__ . ': A salt was used that was less than the advised minimum length of '. self::ADVISED_MIN_SALT_LENGTH . '.');
		}
		// Legacy support for sha1 hashing.
		if (self::HASH_ALGO_SHA1 == $hashAlgorithm) {
			if (self::generatePasswordHash($suppliedPassword, $userSalt, $applicationSalt, self::HASH_ALGO_SHA1, $jumbleSha1Salts) == $passwordHash) {
				return true;
			}

			return false;
		}

		// Default verification using PHP's password_verify function and a hashing mechanism that gets around Bcrypt's 72 character truncation limit.
		return password_verify(self::createSaltedPrehash($suppliedPassword, $userSalt, $applicationSalt), $passwordHash);


	}

	/**
	 * Concatenates a user supplied password with the application salt and the user's salt and returns a hash value. Using salts as long or longer than the ADVISED_MIN_SALT_LENGTH is advised, as is using user and application salts of different lengths.
	 * @param string $password
	 * @param string $userSalt A user-specific salt stored with the password hash.
	 * @param string $applicationSalt An application provided salt, typically used for all users.
	 * @param string $hashAlgorithm Defaults to the contant HASH_ALGO_PASSWORD_HASH for all values except HASH_ALGO_SHA1, which may be used for backwards compatibility, but is not advised.
	 * @param boolean $jumbleSha1Salts Pass false for full backwards compatibility for sha1 hashing. Leave set to default value all new development efforts. This parameter is deprecated.
	 * @return string A hash of arbitrary length by default, 40 characters long if sha1 is used.
	 */
	static public function generatePasswordHash ($password, $userSalt = '', $applicationSalt = '', $hashAlgorithm = self::HASH_ALGO_PASSWORD_HASH, $jumbleSha1Salts = true) {
		// Log warnings about bad salts.
		if (strlen($userSalt) < self::ADVISED_MIN_SALT_LENGTH || strlen($applicationSalt) < self::ADVISED_MIN_SALT_LENGTH) {
			error_log('Line ' . __LINE__ . ' in ' . __CLASS__ . ': A salt was used that was less than the advised minimum length of '. self::ADVISED_MIN_SALT_LENGTH . '.');
		}

		if (self::HASH_ALGO_SHA1 == $hashAlgorithm) { // Legacy option.
			error_log('Line ' . __LINE__ . ' in ' . __CLASS__ .': sha1 password hashing is deprecated and less secure than bcrypt. Consider converting to the more complex Bcrypt algorithm.');

			// Manual salting is not optional for sha1 hashing.
			if ('' == $userSalt || '' == $applicationSalt) {
				throw new Exception('For sha1 hashing, neither the user nor the application salts may be empty. You must supply values for these arguments. Try using the generateSalt() method to create highly random salts.');				
			}

			if ($jumbleSha1Salts) {
				return sha1(self::orderSalts($password, $userSalt, $applicationSalt));
			}
			else {
				// A less secure, fully backwards compatible hashing mechanism that will eventually be removed.
				return sha1($userSalt, $password, $applicationSalt);
			}
		}

		// User salts can, possibly, be identical to application salts if the salts generated were of identical length or if salts are 
		// empty strings. However, this is highly improbable. This error appearing in logs is more likely an indication that bad values
		// are being passed to this method and is indicative of errors in the logic of the application consuming this library.
		if ($userSalt == $applicationSalt) {
			error_log('Line ' . __LINE__ . ' in ' . __CLASS__ . ': Identical values were supplied for the user salt and the application salt. This can happen randomly, but more likely indicates an error in application logic.');
		}

		// Force the use of the standard PHP password_hash() function, but feed it a heavily salted sha512 hash of the password in base 36.
		// to get around Bcrypt's 72 character limit. password_hash() will return a hash, a cost, and a random salt as part
		// of the resulting string.
		return password_hash(self::createSaltedPrehash($password, $userSalt, $applicationSalt), PASSWORD_DEFAULT);

	}

	/**
	 * To integrate the randomness of the password salts, a sha512 salt is created and then base64 encoded.
	 * @param string $password
	 * @param string $userSalt A user-specific salt stored with the password hash.
	 * @param string $applicationSalt An application provided salt, typically used for all users.
	 * @return string The base64 encoded sha512 hash of the salted password.
	 */
	static protected function createSaltedPrehash($password, $userSalt, $applicationSalt) {
		return base64_encode(hash('sha512', self::orderSalts($password, $userSalt, $applicationSalt)));
	}

	/**
	 * For all types of hashing, this library supports manual salts. Salts are concatinated in different orders depending on the user supplied password and user-specific salt.
	 * @param string $password
	 * @param string $userSalt A user-specific salt stored with the password hash.
	 * @param string $applicationSalt An application provided salt, typically used for all users.
	 * @return string The salted password.
	 */
	static protected function orderSalts ($password, $userSalt, $applicationSalt) {
		// Determine order of salt concatenation based on password value.
		$saltedPassword = '';
		if (hexdec(substr(sha1($password), -1 , 1)) % 2) {
			$saltedPassword = $userSalt . $password;
		}
		else {
			$saltedPassword = $password . $userSalt;
		}

		if (hexdec(substr(sha1($saltedPassword), -1 , 1)) % 2) {
			$saltedPassword = $applicationSalt . $saltedPassword;
		}
		else {
			$saltedPassword = $saltedPassword . $applicationSalt;
		}

		return $saltedPassword;
	}

	/**
	 * Generates a random base64 string from a random binary string.
	 * @param integer $streamLength The length of the binary stream that will be encoded.
	 * @return string A base64 encoded random binary stream.
	 */
	static public function generateSalt ($streamLength = self::ADVISED_MIN_SALT_LENGTH) {
		$urandom = \Shoal\Crypt\Urandom::get_instance();
		return $urandom->get_random_base64_string($streamLength);
	}
}
