<?php

namespace App\Fetch\Handler;


use App\Fetch\Exception\Handler\NotValidException;
use App\Fetch\Exception\Handler\UnprocessableException;
use App\Fetch\Pull\PullInterface;
use App\Fetch\Run\RunInterface;

abstract class AbstractHandler implements HandlerInterface, RunInterface
{
//region SECTION: Fields
    protected PullInterface $stream;
    protected array         $data = [];
//endregion Fields
//endregion Fields

//region SECTION: Constructor
    public function __construct(PullInterface $stream)
    {
        $this->stream   = $stream;
    }
//endregion Constructor

//region SECTION: Public
    /**
     * @return HandlerInterface
     * @throws NotValidException
     * @throws UnprocessableException
     */
    public function run(): HandlerInterface
    {
        try {
            $this->data = $this->stream->pull();
        } catch (\Exception $e) {
            throw new UnprocessableException($e->getMessage());
        }

        if (!$this->isValid()) {
            throw new NotValidException();
        }

        return $this;
    }

//endregion Public
//region SECTION: Getters/Setters
    public function getRaw(): array
    {
        return $this->data;
    }
//endregion Getters/Setters
}