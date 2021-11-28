<?php

namespace App\Fetch\Registry;

interface RegistryInterface
{
//region SECTION: Public
    public function add($key, $value): RegistryInterface;

    public function rm($key): RegistryInterface;

    public function all();

    public function has($key):bool;
//endregion Public

//region SECTION: Getters/Setters
    public function get($key);

    public function set(array $cache): RegistryInterface;
//endregion Getters/Setters
}