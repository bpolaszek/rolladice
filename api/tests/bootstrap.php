<?php

namespace App\Tests;

use App\Entity\Club;
use App\Entity\User;
use App\Tests\Factory\ClubFactory;
use App\Tests\Factory\UserFactory;
use Symfony\Component\Dotenv\Dotenv;

require \dirname(__DIR__).'/vendor/autoload.php';

if (\file_exists(\dirname(__DIR__).'/config/bootstrap.php')) {
    require \dirname(__DIR__).'/config/bootstrap.php';
} elseif (\method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(\dirname(__DIR__).'/.env');
}

if ($_SERVER['APP_DEBUG']) {
    \umask(0000);
}

\passthru('APP_ENV=test php bin/console doctrine:database:drop --quiet --if-exists --force');
\passthru('APP_ENV=test php bin/console doctrine:database:create --quiet --if-not-exists');
\passthru('APP_ENV=test php bin/console doctrine:schema:update --quiet --dump-sql --force');
\passthru('APP_ENV=test php bin/console doctrine:fixtures:load --quiet');

function Bob(): User
{
    return UserFactory::find(['email' => 'bob@example.com'])->object();
}

function Alice(): User
{
    return UserFactory::find(['email' => 'alice@example.com'])->object();
}

function Chessy(): Club
{
    return ClubFactory::find(['name' => 'Chessy'])->object();
}

function Triangles(): Club
{
    return ClubFactory::find(['name' => 'Triangles'])->object();
}
