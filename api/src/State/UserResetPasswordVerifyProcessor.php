<?php

namespace App\State;

use ApiPlatform\Doctrine\Common\State\PersistProcessor;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use App\State\Dto\UserResetPasswordToken;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @implements ProcessorInterface<User>
 */
readonly class UserResetPasswordVerifyProcessor implements ProcessorInterface
{
    public function __construct(
        private JWTEncoderInterface $JWTEncoder,
        private UserRepository $repository,
        private UserPasswordHasherInterface $passwordHasher,
        private PersistProcessor $persister,
    ) {
    }

    /**
     * @param UserResetPasswordToken $userResetPasswordToken
     */
    public function process(
        mixed $userResetPasswordToken,
        Operation $operation,
        array $uriVariables = [],
        array $context = [],
    ): User {
        try {
            $claims = $this->JWTEncoder->decode($userResetPasswordToken->token);
        } catch (JWTDecodeFailureException) {
            THROW_INVALID_TOKEN_ERROR:
            throw new AccessDeniedHttpException('Invalid or expired token.');
        }

        $email = $userResetPasswordToken->email;
        $password = $userResetPasswordToken->password;

        if ($email !== $claims['email']) {
            goto THROW_INVALID_TOKEN_ERROR; // I love it 😃
        }

        /** @var User $user */
        $user = $this->repository->findOneBy(['email' => $email]);
        $user->password = $this->passwordHasher->hashPassword($user, $password);

        // ⚠️Important ! Persist changes by ourselves or it won't be done
        $this->persister->process($user, $operation, $uriVariables, $context);

        return $user;
    }
}
