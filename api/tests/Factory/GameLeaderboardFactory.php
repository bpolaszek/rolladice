<?php

namespace App\Tests\Factory;

use App\Entity\GameLeaderboard;
use App\Repository\GameLeaderboardRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<GameLeaderboard>
 *
 * @method        GameLeaderboard|Proxy                     create(array|callable $attributes = [])
 * @method static GameLeaderboard|Proxy                     createOne(array $attributes = [])
 * @method static GameLeaderboard|Proxy                     find(object|array|mixed $criteria)
 * @method static GameLeaderboard|Proxy                     findOrCreate(array $attributes)
 * @method static GameLeaderboard|Proxy                     first(string $sortedField = 'id')
 * @method static GameLeaderboard|Proxy                     last(string $sortedField = 'id')
 * @method static GameLeaderboard|Proxy                     random(array $attributes = [])
 * @method static GameLeaderboard|Proxy                     randomOrCreate(array $attributes = [])
 * @method static GameLeaderboardRepository|RepositoryProxy repository()
 * @method static GameLeaderboard[]|Proxy[]                 all()
 * @method static GameLeaderboard[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static GameLeaderboard[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static GameLeaderboard[]|Proxy[]                 findBy(array $attributes)
 * @method static GameLeaderboard[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static GameLeaderboard[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<GameLeaderboard> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<GameLeaderboard> createOne(array $attributes = [])
 * @phpstan-method static Proxy<GameLeaderboard> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<GameLeaderboard> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<GameLeaderboard> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<GameLeaderboard> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<GameLeaderboard> random(array $attributes = [])
 * @phpstan-method static Proxy<GameLeaderboard> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<GameLeaderboard> repository()
 * @phpstan-method static list<Proxy<GameLeaderboard>> all()
 * @phpstan-method static list<Proxy<GameLeaderboard>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<GameLeaderboard>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<GameLeaderboard>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<GameLeaderboard>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<GameLeaderboard>> randomSet(int $number, array $attributes = [])
 */
final class GameLeaderboardFactory extends ModelFactory
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
            'game' => GameFactory::random(),
            'player' => UserFactory::random(),
            'score' => self::faker()->randomNumber(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(GameLeaderboard $gameLeaderboard): void {})
        ;
    }

    protected static function getClass(): string
    {
        return GameLeaderboard::class;
    }
}
