<?php

namespace App\Tests;


use App\Argument\Operation\Mode;
use PHPUnit\Framework\TestCase;

class ModeUnitTest extends TestCase
{
//region SECTION: Public
    public function testModeSimple()
    {
        $mode = new Mode();

        $this->assertEquals(1, $mode->calculate(4,3));
    }
//endregion Public
}