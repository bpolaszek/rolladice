<?php

namespace App\Tests\Factory;

use App\Entity\Game;
use App\Entity\GameStatus;
use App\Repository\GameRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Game>
 *
 * @method        Game|Proxy                     create(array|callable $attributes = [])
 * @method static Game|Proxy                     createOne(array $attributes = [])
 * @method static Game|Proxy                     find(object|array|mixed $criteria)
 * @method static Game|Proxy                     findOrCreate(array $attributes)
 * @method static Game|Proxy                     first(string $sortedField = 'id')
 * @method static Game|Proxy                     last(string $sortedField = 'id')
 * @method static Game|Proxy                     random(array $attributes = [])
 * @method static Game|Proxy                     randomOrCreate(array $attributes = [])
 * @method static GameRepository|RepositoryProxy repository()
 * @method static Game[]|Proxy[]                 all()
 * @method static Game[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Game[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Game[]|Proxy[]                 findBy(array $attributes)
 * @method static Game[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Game[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<Game> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Game> createOne(array $attributes = [])
 * @phpstan-method static Proxy<Game> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Game> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Game> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Game> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Game> random(array $attributes = [])
 * @phpstan-method static Proxy<Game> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<Game> repository()
 * @phpstan-method static list<Proxy<Game>> all()
 * @phpstan-method static list<Proxy<Game>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<Game>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<Game>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<Game>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<Game>> randomSet(int $number, array $attributes = [])
 */
final class GameFactory extends ModelFactory
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
        $session = GameSessionFactory::random();

        return [
            'session' => $session,
            'startedAt' => $session->day->modify(\sprintf('+%d seconds', \random_int(10, 36000))),
            'status' => self::faker()->randomElement(GameStatus::cases()),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Game $game): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Game::class;
    }
}
