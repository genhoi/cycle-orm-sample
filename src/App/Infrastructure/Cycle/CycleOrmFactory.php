<?php

declare(strict_types=1);

namespace App\Infrastructure\Cycle;

use Cycle\Database\DatabaseManager;
use Cycle\ORM\Entity\Behavior\EventDrivenCommandGenerator;
use Cycle\ORM\Factory;
use Cycle\ORM\ORM;
use Cycle\ORM\ORMInterface;
use Cycle\ORM\Schema;
use Spiral\Core\Container;

class CycleOrmFactory
{

    public static function create(
        DatabaseManager $databaseManager,
        Schema $schema,
    ): ORMInterface
    {
        $container = new Container();
        $commandGenerator = new EventDrivenCommandGenerator($schema, $container);

        return new ORM(
            factory: new Factory($databaseManager),
            schema: $schema,
            commandGenerator: $commandGenerator,
        );
    }
}
