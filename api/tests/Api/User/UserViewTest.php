<?php

namespace App\Tests\Api\User;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\Api\AuthenticatedClient;

use function App\Tests\Bob;

class UserViewTest extends ApiTestCase
{
    use AuthenticatedClient;

    public function testPasswordShouldNotBeExposed(): void
    {
        $api = $this->as(Bob());
        $iri = sprintf('/users/%s', Bob()->id);
        $response = $api->request('GET', $iri);
        $json = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            '@id' => $iri,
            'id' => Bob()->id,
            'email' => Bob()->email,
            'roles' => Bob()->roles,
        ]);
        $this->assertArrayNotHasKey('password', $json);
    }
}
