<?php

namespace Pkboom\TestCreator;

use Illuminate\Support\Collection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;

class CreateTestCommand extends Command
{
    protected function configure()
    {
        $this->setName('create')
            ->setDescription('Create tests in `tests`.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $finder = (new Finder())
            ->name('*.php')
            ->files()
            ->in('src');

        Collection::make($finder)->map(function ($file, $key) {
            return str_replace(['src', '.php'], ['tests', 'Test.php'], $file->getRealPath());
        })->each(function ($file) {
            if (!file_exists(dirname($file))) {
                mkdir(dirname($file), 0777, true);
            }

            $class = str_replace([dirname($file), '/', '.php'], '', $file);

            if (!file_exists($file)) {
                file_put_contents($file, $this->getContent($class));
            }
        });

        $output = new SymfonyStyle($input, $output);

        $output->text('Tests created.');

        return static::SUCCESS;
    }

    public function getContent($class)
    {
        $namespace = __NAMESPACE__;

        return <<<TEST
<?php

namespace $namespace\Test;

use PHPUnit\Framework\TestCase;

class $class extends TestCase
{

}
TEST;
    }
}
