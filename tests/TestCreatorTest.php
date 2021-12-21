<?php

namespace Pkboom\TestCreator\Test;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

class TestCreatorTest extends TestCase
{
    /** @test */
    public function the_creator_can_be_executed()
    {
        $process = new Process(['php', 'test-creator']);

        $process->run();

        $this->assertTrue($process->isSuccessful());
    }
}
