<?php


namespace App\Tests;

use Evrinoma\RpnBundle\Calc\RpnCalc;
use Evrinoma\RpnBundle\Command\CalcCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use PHPUnit\Framework\TestCase;

class CommandUnitTest extends TestCase
{

    private $mock;
    /**
     * @var CommandTester
     */
    private $commandTester;

    protected function setUp():void
    {
        $this->mock = $this->getMockBuilder(RpnCalc::class)
            ->disableOriginalConstructor()
            ->getMock();

        $application = new Application();
        $application->add(new CalcCommand($this->mock));
        $command = $application->find('evrinoma:calc');
        $this->commandTester = new CommandTester($command);
    }

    public function testExecute()
    {

        $this->commandTester->execute(['--formula' => '10+3']);

        $this->assertEquals("============\nFormula: [10+3 = 0]\n============", trim($this->commandTester->getDisplay()));
    }
}