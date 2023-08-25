<?php

namespace App\Tests\Factory;

use App\Entity\GameSessionLeaderboard;
use App\Repository\GameSessionLeaderboardRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<GameSessionLeaderboard>
 *
 * @method        GameSessionLeaderboard|Proxy                     create(array|callable $attributes = [])
 * @method static GameSessionLeaderboard|Proxy                     createOne(array $attributes = [])
 * @method static GameSessionLeaderboard|Proxy                     find(object|array|mixed $criteria)
 * @method static GameSessionLeaderboard|Proxy                     findOrCreate(array $attributes)
 * @method static GameSessionLeaderboard|Proxy                     first(string $sortedField = 'id')
 * @method static GameSessionLeaderboard|Proxy                     last(string $sortedField = 'id')
 * @method static GameSessionLeaderboard|Proxy                     random(array $attributes = [])
 * @method static GameSessionLeaderboard|Proxy                     randomOrCreate(array $attributes = [])
 * @method static GameSessionLeaderboardRepository|RepositoryProxy repository()
 * @method static GameSessionLeaderboard[]|Proxy[]                 all()
 * @method static GameSessionLeaderboard[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static GameSessionLeaderboard[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static GameSessionLeaderboard[]|Proxy[]                 findBy(array $attributes)
 * @method static GameSessionLeaderboard[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static GameSessionLeaderboard[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<GameSessionLeaderboard> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<GameSessionLeaderboard> createOne(array $attributes = [])
 * @phpstan-method static Proxy<GameSessionLeaderboard> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<GameSessionLeaderboard> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<GameSessionLeaderboard> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<GameSessionLeaderboard> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<GameSessionLeaderboard> random(array $attributes = [])
 * @phpstan-method static Proxy<GameSessionLeaderboard> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<GameSessionLeaderboard> repository()
 * @phpstan-method static list<Proxy<GameSessionLeaderboard>> all()
 * @phpstan-method static list<Proxy<GameSessionLeaderboard>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<GameSessionLeaderboard>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<GameSessionLeaderboard>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<GameSessionLeaderboard>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<GameSessionLeaderboard>> randomSet(int $number, array $attributes = [])
 */
final class GameSessionLeaderboardFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'player' => UserFactory::random(),
            'session' => GameSessionFactory::random(),
            'score' => self::faker()->randomNumber(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(GameSessionLeaderboard $gameSessionLeaderboard): void {})
        ;
    }

    protected static function getClass(): string
    {
        return GameSessionLeaderboard::class;
    }
}
