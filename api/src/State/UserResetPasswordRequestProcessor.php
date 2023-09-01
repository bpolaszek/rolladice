<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * @implements ProcessorInterface<void>
 */
readonly class UserResetPasswordRequestProcessor implements ProcessorInterface
{
    public function __construct(
        private UserRepository $repository,
        private JWTEncoderInterface $JWTEncoder,
        private MailerInterface $mailer,
    ) {
    }

    /**
     * @param User                 $user
     * @param array<string, mixed> $uriVariables
     * @param array<string, mixed> $context
     */
    public function process(
        mixed $user,
        Operation $operation,
        array $uriVariables = [],
        array $context = [],
    ): void {
        // Ensure email exists
        if (!$this->repository->findOneBy(['email' => $user->email])) {
            return;
        }

        // Sign a JWT that we'll send by mail
        $jwt = $this->JWTEncoder->encode(['email' => $user->email]);
        $link = \sprintf('https://some-ui.com/reset-password?email=%s&token=%s', $user->email, $jwt);

        $message = (new Email())
            ->to($user->email)
            ->subject('Password reinitialization')
            ->text(
                <<<TEXT
Hey 👋
Want to reset your password? Follow that link: {$link}

Cheers! 🍻
TEXT,
            );

        $this->mailer->send($message);
    }
}
