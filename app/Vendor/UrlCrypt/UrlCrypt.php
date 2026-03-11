<?php
/**
 * UrlCrypt — AES-256-CBC + HMAC-SHA256 URL encryption/decryption.
 * Mirrors the alvar27/url-dcrypt approach adapted for PHP 5.6.
 *
 * Usage:
 *   $token = UrlCrypt::encrypt($plainUrl, $key, $secret);
 *   $plain = UrlCrypt::decrypt($token, $key, $secret);
 */
if (!function_exists('hash_equals')) {
    function hash_equals($known_string, $user_string) {
        if (strlen($known_string) !== strlen($user_string)) {
            return false;
        }
        $result = 0;
        for ($i = 0; $i < strlen($known_string); $i++) {
            $result |= ord($known_string[$i]) ^ ord($user_string[$i]);
        }
        return $result === 0;
    }
}

class UrlCrypt {

    const CIPHER  = 'AES-256-CBC';
    const HMAC_ALGO = 'sha256';
    const IV_LENGTH = 16;
    const HMAC_LENGTH = 32; // SHA-256 raw = 32 bytes

    /**
     * Encrypt a URL string.
     * Returns a URL-safe base64 string: HMAC(32) + IV(16) + CIPHERTEXT
     */
    public static function encrypt($data, $key, $secret) {
        $key = self::normaliseKey($key);
        $iv  = openssl_random_pseudo_bytes(self::IV_LENGTH);
        $cipher = openssl_encrypt($data, self::CIPHER, $key, OPENSSL_RAW_DATA, $iv);
        if ($cipher === false) {
            return false;
        }
        $hmac    = hash_hmac(self::HMAC_ALGO, $iv . $cipher, $secret, true);
        $payload = $hmac . $iv . $cipher;
        return rtrim(strtr(base64_encode($payload), '+/', '-_'), '=');
    }

    /**
     * Decrypt a token produced by encrypt().
     * Returns the original plain string, or false on failure / tampered data.
     */
    public static function decrypt($token, $key, $secret) {
        $key     = self::normaliseKey($key);
        $payload = base64_decode(strtr($token, '-_', '+/'));
        if ($payload === false || strlen($payload) < self::HMAC_LENGTH + self::IV_LENGTH + 1) {
            return false;
        }
        $hmac      = substr($payload, 0, self::HMAC_LENGTH);
        $iv        = substr($payload, self::HMAC_LENGTH, self::IV_LENGTH);
        $cipher    = substr($payload, self::HMAC_LENGTH + self::IV_LENGTH);
        $expected  = hash_hmac(self::HMAC_ALGO, $iv . $cipher, $secret, true);
        if (!hash_equals($expected, $hmac)) {
            return false; // Integrity check failed — tampered token
        }
        return openssl_decrypt($cipher, self::CIPHER, $key, OPENSSL_RAW_DATA, $iv);
    }

    /**
     * Pad or truncate key to exactly 32 bytes for AES-256.
     */
    private static function normaliseKey($key) {
        return substr(str_pad($key, 32, "\0"), 0, 32);
    }
}
