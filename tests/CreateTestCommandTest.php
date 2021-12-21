<?php

namespace Pkboom\TestCreator\Test;

use PHPUnit\Framework\TestCase;
use Pkboom\TestCreator\CreateTestCommand;

class CreateTestCommandTest extends TestCase
{
    /** @test */
    public function it_can_be_instantiated()
    {
        $command = new CreateTestCommand();

        $this->assertInstanceOf(CreateTestCommand::class, $command);
    }
}
