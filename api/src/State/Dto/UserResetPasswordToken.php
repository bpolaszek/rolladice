<?php

declare(strict_types=1);

namespace App\State\Dto;

use App\Entity\User;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

final class UserResetPasswordToken
{
    #[Assert\Email(groups: [User::RESET_PASSWORD])]
    #[Assert\NotNull(groups: [User::RESET_PASSWORD])]
    #[Serializer\Groups([User::RESET_PASSWORD])]
    public ?string $email = null;

    #[Assert\NotNull(groups: [User::RESET_PASSWORD])]
    #[Serializer\Groups([User::RESET_PASSWORD])]
    public ?string $token = null;

    #[Assert\NotCompromisedPassword(groups: [User::RESET_PASSWORD])]
    #[Serializer\Groups([User::RESET_PASSWORD])]
    public ?string $password = null;
}
