<?php

namespace Pkboom\TestCreator;

use Symfony\Component\Console\Application;

class ConsoleApplication extends Application
{
    public function __construct()
    {
        parent::__construct('Test Creator', '0.1');

        $this->add(new CreateTestCommand());
    }

    public function getLongVersion()
    {
        return parent::getLongVersion().' by <comment>Pkboom</comment>';
    }
}
