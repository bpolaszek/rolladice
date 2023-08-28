<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

if (file_exists(dirname(__DIR__).'/config/bootstrap.php')) {
    require dirname(__DIR__).'/config/bootstrap.php';
} elseif (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}

if ($_SERVER['APP_DEBUG']) {
    umask(0000);
}

passthru('APP_ENV=test php bin/console doctrine:database:drop --quiet --if-exists --force');
passthru('APP_ENV=test php bin/console doctrine:database:create --quiet --if-not-exists');
passthru('APP_ENV=test php bin/console doctrine:schema:update --quiet --dump-sql --force');
passthru('APP_ENV=test php bin/console doctrine:fixtures:load --quiet');
