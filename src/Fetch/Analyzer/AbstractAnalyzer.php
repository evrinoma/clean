<?php

namespace App\Fetch\Analyzer;

use App\Fetch\Registry\RegistryTrait;

abstract class AbstractAnalyzer implements AnalyzerInterface
{
    use RegistryTrait;
//region SECTION: Fields
    protected array        $error = [];
//endregion Fields

//region SECTION: Protected
    protected function addError(string $error): AbstractAnalyzer
    {
        $this->error[] = $error;

        return $this;
    }
//endregion Protected
}