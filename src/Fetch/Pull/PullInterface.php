<?php

namespace App\Fetch\Pull;

use App\Fetch\Exception\Description\CommunicationException;
use App\Fetch\Exception\Description\DescriptionNotValidException;

interface PullInterface
{
    /**
     * @throws CommunicationException
     * @throws DescriptionNotValidException
     * @return array
     */
    public function pull(): array;
}