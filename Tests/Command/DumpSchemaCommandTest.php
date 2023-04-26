<?php

namespace TheCodingMachine\GraphQLite\Bundle\Tests\Command;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use TheCodingMachine\GraphQLite\Bundle\Tests\GraphQLiteTestingKernel;

class DumpSchemaCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $kernel = new GraphQLiteTestingKernel();
        $application = new Application($kernel);

        $command = $application->find('graphqlite:dump-schema');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        self::assertRegExp(
            '/type Product {[\s"]*seller: Contact\s*name: String!\s*price: Float!\s*}/',
            $commandTester->getDisplay()
        );
    }
}
