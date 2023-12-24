<?php



namespace App\Helper;

abstract class Session
{

    public static function save(string $key, mixed $value): void
    {
        self::onStart();
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     * @return array|null
     */
    public static function get(string $key): ?array
    {
        self::onStart();
        return self::has($key) ? $_SESSION[$key] : null;
    }

    /**
     *
     * @param string $key
     * @return void
     */
    public static function delete(string $key): void
    {
        self::onStart();
        if (self::has($key)){
            unset($_SESSION[$key]);
        }
    }

    /**
     * @param string $key
     * @return boolean
     */
    public static function has(string $key): bool
    {
        self::onStart();
        return isset($_SESSION[$key]);
    }

    /**
     * @return void
     */
    private static function onStart (): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}