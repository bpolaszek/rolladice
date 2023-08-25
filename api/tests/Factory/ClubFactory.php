<?php

namespace App\Tests\Factory;

use App\Entity\Club;
use App\Repository\ClubRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Club>
 *
 * @method        Club|Proxy                     create(array|callable $attributes = [])
 * @method static Club|Proxy                     createOne(array $attributes = [])
 * @method static Club|Proxy                     find(object|array|mixed $criteria)
 * @method static Club|Proxy                     findOrCreate(array $attributes)
 * @method static Club|Proxy                     first(string $sortedField = 'id')
 * @method static Club|Proxy                     last(string $sortedField = 'id')
 * @method static Club|Proxy                     random(array $attributes = [])
 * @method static Club|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ClubRepository|RepositoryProxy repository()
 * @method static Club[]|Proxy[]                 all()
 * @method static Club[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Club[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Club[]|Proxy[]                 findBy(array $attributes)
 * @method static Club[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Club[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<Club> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Club> createOne(array $attributes = [])
 * @phpstan-method static Proxy<Club> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Club> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Club> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Club> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Club> random(array $attributes = [])
 * @phpstan-method static Proxy<Club> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<Club> repository()
 * @phpstan-method static list<Proxy<Club>> all()
 * @phpstan-method static list<Proxy<Club>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<Club>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<Club>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<Club>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<Club>> randomSet(int $number, array $attributes = [])
 */
final class ClubFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->company(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Club $club): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Club::class;
    }
}
