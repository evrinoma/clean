<?php

namespace App\Fetch\Analyzer;

use App\Fetch\Registry\RegistryInterface;

interface AnalyzerInterface extends RegistryInterface
{
//region SECTION: Public
    public function doAnalyze();
//endregion Public
}