<?php


namespace App\Argument\Operation;


use Evrinoma\RpnBundle\Argument\Operation\OperationFactory;
use Evrinoma\RpnBundle\Interfaces\OperationInterface;


class MyOperationFactory extends OperationFactory
{
//region SECTION: Fields
    protected $pool = [];
    private $mode;
//endregion Fields

//region SECTION: Constructor
    public function __construct()
    {
        $this->pool[Mode::OPERATION] = $this->operationMode();
    }
//endregion Constructor

//region SECTION: Private
    private function &operationMode()
    {
        if (!$this->mode) {
            $this->mode = new Mode();
        }

        return $this->mode;
    }
//endregion Private

//region SECTION: Getters/Setters
    /**
     * @param string $operation
     *
     * @return OperationInterface
     * @throws \Exception
     */
    public function getOperation(string $operation): OperationInterface
    {
        if (array_key_exists($operation, $this->pool)) {
            return $this->pool[$operation];
        } else {
            return parent::getOperation($operation);
        }
    }
//endregion Getters/Setters
}