<?php

declare(strict_types=1);

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\Client;
use App\Entity\User;

trait AuthenticatedClient
{
    protected function as(User $user): Client
    {
        $client = static::createClient();
        $response = $client->request(
            'POST',
            '/login_check',
            [
                'json' => [
                    'username' => $user->email,
                    'password' => $_SERVER['DEFAULT_USER_PASSWORD'],
                ],
            ],
        );

        $data = $response->toArray();
        $client->setDefaultOptions([
            'auth_bearer' => $data['token'],
        ]);

        return $client;
    }
}
