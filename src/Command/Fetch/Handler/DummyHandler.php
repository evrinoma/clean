<?php

namespace App\Command\Fetch\Handler;

use App\Fetch\Handler\AbstractHandler;

class DummyHandler extends AbstractHandler
{

//region SECTION: Public
    public function isValid(): bool
    {
        return array_key_exists('success', $this->data) && $this->data['success'];
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getData(): \Generator
    {
        foreach ($this->data['rates'] as $key => $value) {
            yield $key => $value;
        }
    }

    public function getHeader(): \Generator
    {
        foreach ($this->data as $key => $value) {
            if ($key != 'rates') {
                yield $key => $value;
            }
        }
    }
//endregion Getters/Setters
}