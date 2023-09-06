<?php

namespace App\Tests\Api\User;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\State\Dto\UserResetPasswordToken;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Email;
use VStelmakh\UrlHighlight\UrlHighlight;

use function App\Tests\Alice;
use function App\Tests\Bob;
use function BenTools\QueryString\query_string;
use function BenTools\UriFactory\Helper\uri;

class UserResetPasswordTest extends ApiTestCase
{
    public function testAKnownUserCanRequestAPasswordReset(): UserResetPasswordToken
    {
        static::createClient()->request('POST', '/auth/reset-password', [
            'json' => [
                'email' => Bob()->email,
            ],
        ]);

        self::assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);
        self::assertEmailCount(1);

        /** @var Email $email */
        $email = self::getMailerMessage();
        self::assertEmailTextBodyContains($email, 'Want to reset your password? Follow that link');

        $url = (new UrlHighlight())->getUrls($email->getTextBody())[0];
        $token = query_string(uri($url))->getParam('token');

        $resetPasswordRequest = new UserResetPasswordToken();
        $resetPasswordRequest->email = Bob()->email;
        $resetPasswordRequest->password = 'N3wP4ssw0rd';
        $resetPasswordRequest->token = $token;

        return $resetPasswordRequest;
    }

    public function testAnUnknownUserGetsANotFoundError(): void
    {
        static::createClient()->request('POST', '/auth/reset-password', [
            'json' => [
                'email' => 'foobar@example.com',
            ],
        ]);

        self::assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
    }

    /**
     * @depends testAKnownUserCanRequestAPasswordReset
     */
    public function testAUserCanRequestANewPasswordWithAValidToken(UserResetPasswordToken $payload): void
    {
        static::createClient()->request('POST', '/auth/reset-password-verify', [
            'json' => $payload,
        ]);

        self::assertResponseIsSuccessful();
    }

    /**
     * @depends testAKnownUserCanRequestAPasswordReset
     */
    public function testAUserCannotUseAnInvalidToken(UserResetPasswordToken $payload): void
    {
        $payload = clone $payload;
        $payload->token = \bin2hex(\random_bytes(32));
        static::createClient()->request('POST', '/auth/reset-password-verify', [
            'json' => $payload,
        ]);

        self::assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    /**
     * @depends testAKnownUserCanRequestAPasswordReset
     */
    public function testAUserCannotUseATokenWithADifferentEmail(UserResetPasswordToken $payload): void
    {
        $payload = clone $payload;
        $payload->email = Alice()->email;
        static::createClient()->request('POST', '/auth/reset-password-verify', [
            'json' => $payload,
        ]);

        self::assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    public function testNotProvidingAnEmailShouldResultInABadRequest(): void
    {
        static::createClient()->request('POST', '/auth/reset-password-verify', [
            'json' => [],
        ]);

        self::assertResponseStatusCodeSame(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
