<?php

namespace App\Command\Fetch\Handler;


use Evrinoma\FetchBundle\Handler\AbstractHandler;

class DummyHandler extends AbstractHandler
{

//region SECTION: Public
    public function isValid(): bool
    {
        return array_key_exists('success', $this->data) && $this->data['success'];
    }
//endregion Public
}