<?php

namespace App\Fetch\Description;

use App\Fetch\Exception\Description\CommunicationException;
use App\Fetch\Exception\Description\DescriptionNotValidException;

interface DescriptionInterface
{
//region SECTION: Public
    /**
     * @throws CommunicationException
     * @return array
     */
    public function load():array;

    /**
     * @throws DescriptionNotValidException
     * @return bool
     */
    public function configure(): bool;
//endregion Public
}