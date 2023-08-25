<?php

namespace App\Tests\Factory;

use App\Entity\GameSession;
use App\Entity\GameSessionStatus;
use App\Repository\GameSessionRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<GameSession>
 *
 * @method        GameSession|Proxy                     create(array|callable $attributes = [])
 * @method static GameSession|Proxy                     createOne(array $attributes = [])
 * @method static GameSession|Proxy                     find(object|array|mixed $criteria)
 * @method static GameSession|Proxy                     findOrCreate(array $attributes)
 * @method static GameSession|Proxy                     first(string $sortedField = 'id')
 * @method static GameSession|Proxy                     last(string $sortedField = 'id')
 * @method static GameSession|Proxy                     random(array $attributes = [])
 * @method static GameSession|Proxy                     randomOrCreate(array $attributes = [])
 * @method static GameSessionRepository|RepositoryProxy repository()
 * @method static GameSession[]|Proxy[]                 all()
 * @method static GameSession[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static GameSession[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static GameSession[]|Proxy[]                 findBy(array $attributes)
 * @method static GameSession[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static GameSession[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<GameSession> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<GameSession> createOne(array $attributes = [])
 * @phpstan-method static Proxy<GameSession> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<GameSession> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<GameSession> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<GameSession> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<GameSession> random(array $attributes = [])
 * @phpstan-method static Proxy<GameSession> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<GameSession> repository()
 * @phpstan-method static list<Proxy<GameSession>> all()
 * @phpstan-method static list<Proxy<GameSession>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<GameSession>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<GameSession>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<GameSession>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<GameSession>> randomSet(int $number, array $attributes = [])
 */
final class GameSessionFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'club' => ClubFactory::random(),
            'day' => \DateTimeImmutable::createFromMutable(
                self::faker()->dateTimeBetween('-3 day', 'now')
            ),
            'iteration' => self::faker()->randomNumber(), // Not perfect... 🤔
            'status' => self::faker()->randomElement(GameSessionStatus::cases()),
        ];
    }

    protected function initialize(): self
    {
        return $this
             ->afterInstantiate(function (GameSession $gameSession): void {
                 static $sequences = [];
                 $sequences[$gameSession->day->format('Ymd')] ??= 0; // Reset chaque jour de l'itération
                 $gameSession->iteration = ++$sequences[$gameSession->day->format('Ymd')]; // Nombre séquentiel
             })
        ;
    }

    protected static function getClass(): string
    {
        return GameSession::class;
    }
}
