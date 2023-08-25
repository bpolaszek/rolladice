<?php

namespace App\Tests\Factory;

use App\Entity\ClubMember;
use App\Entity\ClubMemberRole;
use App\Repository\ClubMemberRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ClubMember>
 *
 * @method        ClubMember|Proxy                     create(array|callable $attributes = [])
 * @method static ClubMember|Proxy                     createOne(array $attributes = [])
 * @method static ClubMember|Proxy                     find(object|array|mixed $criteria)
 * @method static ClubMember|Proxy                     findOrCreate(array $attributes)
 * @method static ClubMember|Proxy                     first(string $sortedField = 'id')
 * @method static ClubMember|Proxy                     last(string $sortedField = 'id')
 * @method static ClubMember|Proxy                     random(array $attributes = [])
 * @method static ClubMember|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ClubMemberRepository|RepositoryProxy repository()
 * @method static ClubMember[]|Proxy[]                 all()
 * @method static ClubMember[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static ClubMember[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static ClubMember[]|Proxy[]                 findBy(array $attributes)
 * @method static ClubMember[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static ClubMember[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<ClubMember> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<ClubMember> createOne(array $attributes = [])
 * @phpstan-method static Proxy<ClubMember> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<ClubMember> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<ClubMember> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<ClubMember> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<ClubMember> random(array $attributes = [])
 * @phpstan-method static Proxy<ClubMember> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<ClubMember> repository()
 * @phpstan-method static list<Proxy<ClubMember>> all()
 * @phpstan-method static list<Proxy<ClubMember>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<ClubMember>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<ClubMember>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<ClubMember>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<ClubMember>> randomSet(int $number, array $attributes = [])
 */
final class ClubMemberFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'club' => ClubFactory::random(), // Random dans les clubs déjà générés
            'member' => UserFactory::random(), // Random dans les users déjà générés
            'role' => self::faker()->randomElement(ClubMemberRole::cases()), // Hello enum 👋
        ];
    }

    protected static function getClass(): string
    {
        return ClubMember::class;
    }
}
