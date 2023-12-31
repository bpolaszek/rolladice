<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\UserRepository;
use App\State\Dto\UserResetPasswordToken;
use App\State\UserResetPasswordRequestProcessor;
use App\State\UserResetPasswordVerifyProcessor;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new GetCollection(normalizationContext: ['groups' => [self::LIST]]),
        new Get(normalizationContext: ['groups' => [self::VIEW]]),
        new Post(
            uriTemplate: '/auth/reset-password',
            denormalizationContext: ['groups' => [self::RESET_PASSWORD]],
            validationContext: ['groups' => [self::RESET_PASSWORD]],
            processor: UserResetPasswordRequestProcessor::class,
            status: Response::HTTP_NO_CONTENT,
        ),
        new Post(
            uriTemplate: '/auth/reset-password-verify',
            normalizationContext: ['groups' => [self::VIEW]],
            denormalizationContext: ['groups' => [self::RESET_PASSWORD]],
            validationContext: ['groups' => [self::RESET_PASSWORD]],
            processor: UserResetPasswordVerifyProcessor::class,
            input: UserResetPasswordToken::class,
        ),
        new Post(
            normalizationContext: ['groups' => [self::VIEW]],
            denormalizationContext: ['groups' => [self::CREATE]],
            validationContext: ['groups' => [self::CREATE]],
        ),
        new Put(
            normalizationContext: ['groups' => [self::VIEW]],
            denormalizationContext: ['groups' => [self::UPDATE]],
            validationContext: ['groups' => [self::UPDATE]],
        ),
    ],
)]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public const LIST = 'user:list';
    public const VIEW = 'user:view';
    public const CREATE = 'user:create';
    public const RESET_PASSWORD = 'user:reset-password';
    public const UPDATE = 'user:update';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Serializer\Groups([self::LIST, self::VIEW])]
    public ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Serializer\Groups([self::LIST, self::VIEW, self::CREATE, self::UPDATE, self::RESET_PASSWORD])]
    #[Assert\Email(groups: [self::CREATE, self::UPDATE, self::RESET_PASSWORD])]
    #[Assert\NotNull(groups: [self::CREATE, self::RESET_PASSWORD])]
    public ?string $email = null;

    /**
     * @var string[]
     */
    #[ORM\Column]
    #[Serializer\Groups([self::VIEW])]
    public array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Serializer\Groups([self::CREATE, self::UPDATE])]
    #[Assert\NotCompromisedPassword(groups: [self::CREATE, self::UPDATE])]
    #[Assert\NotNull(groups: [self::CREATE])]
    public ?string $password = null;

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     *
     * @codeCoverageIgnore
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @codeCoverageIgnore
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     *
     * @codeCoverageIgnore
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @see UserInterface
     *
     * @codeCoverageIgnore
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
