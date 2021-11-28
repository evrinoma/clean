<?php

namespace App\Fetch\Registry;

trait RegistryTrait
{
//region SECTION: Fields
    protected static array $cache = [];
//endregion Fields

//region SECTION: Protected
    protected static function addCache($key, $value): void
    {
        if (!static::getCache($key)) {
            static::$cache[$key] = $value;
        }
    }

    protected static function rmCache($key): void
    {
        if (static::getCache($key)) {
            unset(static::$cache[$key]);
        }
    }

    protected static function allCache()
    {
        return static::$cache;
    }

    protected static function hasCache($key)
    {
        return array_key_exists($key, static::$cache);
    }

    protected static function getCache($key)
    {
        return array_key_exists($key, static::$cache) ? static::$cache[$key] : null;
    }
//endregion Protected

//region SECTION: Public
    public function add($key, $value): RegistryInterface
    {
        static::addCache($key, $value);

        return $this;
    }

    public function rm($key): RegistryInterface
    {
        static::rmCache($key);

        return $this;
    }

    public function all()
    {
        return static::allCache();
    }
//endregion Public

//region SECTION: Getters/Setters
    public function has($key):bool
    {
        return static::hasCache($key);
    }

    public function get($key)
    {
        return static::getCache($key);
    }

    public static function setCache(array $cache): void
    {
        static::$cache = $cache;
    }

    public function set(array $cache): RegistryInterface
    {
        static::setCache($cache);

        return $this;
    }
//endregion Getters/Setters
}