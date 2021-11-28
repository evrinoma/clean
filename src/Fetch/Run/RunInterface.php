<?php

namespace App\Fetch\Run;

use App\Fetch\Exception\Handler\UnprocessableException;
use App\Fetch\Exception\Handler\NotValidException;
use App\Fetch\Handler\HandlerInterface;

interface RunInterface
{
    /**
     * @return HandlerInterface
     * @throws NotValidException
     * @throws UnprocessableException
     */
    public function run(): HandlerInterface;
}