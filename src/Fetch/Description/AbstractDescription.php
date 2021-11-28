<?php

namespace App\Fetch\Description;

use App\Fetch\Exception\Description\CommunicationException;
use App\Fetch\Exception\Description\DescriptionNotValidException;
use App\Fetch\Pull\PullInterface;

abstract class AbstractDescription implements DescriptionInterface, PullInterface
{
//region SECTION: Public
    /**
     * @return array
     * @throws CommunicationException
     * @throws DescriptionNotValidException
     */
    public function pull(): array
    {
        try {
            $data = $this->configure() ? $this->load() : [];
        } catch (\Exception $e) {
            throw $e;
        }

        return $data;
    }
//endregion Public
}