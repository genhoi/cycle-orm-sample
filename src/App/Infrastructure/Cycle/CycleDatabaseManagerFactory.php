<?php

declare(strict_types=1);

namespace App\Infrastructure\Cycle;

use Cycle\Database\Config;
use Cycle\Database\Config\DatabaseConfig;
use Cycle\Database\Config\PostgresDriverConfig;
use Cycle\Database\DatabaseManager;
use Cycle\Database\Driver\Postgres\PostgresDriver;

class CycleDatabaseManagerFactory
{
    public static function create(
        string $host,
        int $port,
        string $user,
        string $password,
        string $database,
        string $schema,
    ): DatabaseManager
    {
        return new DatabaseManager(
            new DatabaseConfig([
                'default' => 'default',
                'databases' => [
                    'default' => ['connection' => 'postgres'],
                ],
                'connections' => [
                    'postgres' => new PostgresDriverConfig(
                        connection: new Config\Postgres\TcpConnectionConfig(
                            database: $database,
                            host: $host,
                            port: $port,
                            user: $user,
                            password: $password,
                        ),
                        schema: $schema,
                        driver: PostgresDriver::class,
                        queryCache: true,
                        options: [
                            'withDatetimeMicroseconds' => true,
                        ],
                    ),
                ],
            ])
        );
    }
}
