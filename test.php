<?php

require_once __DIR__.'/vendor/autoload.php';

use App\Domain\Entity\Bid;
use App\Domain\Entity\BidDelivery;
use App\Infrastructure\Cycle\CycleDatabaseManagerFactory;
use App\Infrastructure\Cycle\CycleOrmFactory;
use Cycle\ORM\Mapper\Mapper;
use Cycle\ORM\Parser\Typecast;
use Cycle\ORM\Relation;
use Cycle\ORM\Schema;
use Cycle\ORM;

$manager = CycleDatabaseManagerFactory::create(
    host: 'db',
    port: 5432,
    user: 'user',
    password: 'password',
    database: '',
    schema: 'sample',
);
$orm = CycleOrmFactory::create($manager, new Schema([
    'bids' => [
        ORM\SchemaInterface::MAPPER => Mapper::class,
        ORM\SchemaInterface::ENTITY => Bid::class,
        ORM\SchemaInterface::TABLE => 'bids',
        ORM\SchemaInterface::PRIMARY_KEY => 'id',
        ORM\SchemaInterface::TYPECAST_HANDLER => [
            Typecast::class,
        ],
        ORM\SchemaInterface::COLUMNS => [
            'id' => 'id',
            'code' => 'code',
            'bidDeliveryCode' => 'bid_delivery_code',
        ],
        ORM\SchemaInterface::TYPECAST => [
            'id' => 'int',
            'code' => 'string',
            'bidDeliveryCode' => 'string',
        ],
        ORM\SchemaInterface::RELATIONS => [
            'bidDelivery' => [
                Relation::TYPE => Relation::HAS_ONE,
                Relation::TARGET => BidDelivery::class,
                Relation::SCHEMA => [
                    Relation::CASCADE => false,
                    Relation::INNER_KEY => 'bidDeliveryCode',
                    Relation::OUTER_KEY => 'code',
                ],
            ],
        ],
    ],
    'bid_deliveries' => [
        ORM\SchemaInterface::MAPPER => Mapper::class,
        ORM\SchemaInterface::ENTITY => BidDelivery::class,
        ORM\SchemaInterface::TABLE => 'bid_deliveries',
        ORM\SchemaInterface::PRIMARY_KEY => 'id',
        ORM\SchemaInterface::TYPECAST_HANDLER => [
            Typecast::class,
        ],
        ORM\SchemaInterface::COLUMNS => [
            'id' => 'id',
            'code' => 'code',
        ],
        ORM\SchemaInterface::TYPECAST => [
            'id' => 'int',
            'code' => 'string',
        ],
        ORM\SchemaInterface::RELATIONS => [
            'bids' => [
                Relation::TYPE => Relation::HAS_MANY,
                Relation::TARGET => Bid::class,
                Relation::SCHEMA => [
                    Relation::CASCADE => false,
                    Relation::INNER_KEY => 'code',
                    Relation::OUTER_KEY => 'bidDeliveryCode',
                ],
            ],
        ],
    ],
]));

$bid = new Bid(1, 'BID1');

$em = new ORM\EntityManager($orm);
$em->persist($bid);
$em->run();