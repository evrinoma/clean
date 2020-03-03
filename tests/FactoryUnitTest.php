<?php

namespace App\Tests;


use App\Argument\Operation\MyOperationFactory;
use PHPUnit\Framework\TestCase;

class FactoryUnitTest extends TestCase
{
    /**
     * @var MyOperationFactory
     */
    private $factory;

    public function setUp():void
    {
        $this->factory = new MyOperationFactory();
    }

//region SECTION: Public
    public function testMyOperationFactorySimple()
    {
        $operation = '%';
        $mode = $this->factory->getOperation($operation);
        $this->assertEquals($operation,$mode->operation());
    }
//endregion Public
}