<?php

declare(strict_types=1);

namespace OwenVoke\Ecologi;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use OwenVoke\Ecologi\Api\AbstractApi;
use OwenVoke\Ecologi\Api\Purchasing;
use OwenVoke\Ecologi\Api\Reporting;
use OwenVoke\Ecologi\Exception\BadMethodCallException;
use OwenVoke\Ecologi\Exception\InvalidArgumentException;
use OwenVoke\Ecologi\HttpClient\Builder;
use OwenVoke\Ecologi\HttpClient\Plugin\Authentication;
use Psr\Http\Client\ClientInterface;

/**
 * @method Api\Purchasing purchase()
 * @method Api\Purchasing purchasing()
 * @method Api\Reporting report()
 * @method Api\Reporting reporting()
 */
final class Client
{
    public const AUTH_ACCESS_TOKEN = 'access_token_header';

    private Builder $httpClientBuilder;

    public function __construct(Builder $httpClientBuilder = null)
    {
        $this->httpClientBuilder = $builder = $httpClientBuilder ?? new Builder();

        $builder->addPlugin(new RedirectPlugin());
        $builder->addPlugin(new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri('https://public.ecologi.com')));
        $builder->addPlugin(new HeaderDefaultsPlugin([
            'User-Agent' => 'ecologi-php (https://github.com/owenvoke/ecologi-php)',
        ]));

        $builder->addHeaderValue('Accept', 'application/json');
    }

    public static function createWithHttpClient(ClientInterface $httpClient): self
    {
        $builder = new Builder($httpClient);

        return new self($builder);
    }

    /** @throws InvalidArgumentException */
    public function api(string $name): AbstractApi
    {
        switch ($name) {
            case 'purchase':
            case 'purchasing':
                return new Purchasing($this);

            case 'report':
            case 'reporting':
                return new Reporting($this);

            default:
                throw new InvalidArgumentException(sprintf('Undefined api instance called: "%s"', $name));
        }
    }

    public function authenticate(string $tokenOrLogin, ?string $password = null, ?string $authMethod = null): void
    {
        if (null === $password && null === $authMethod) {
            throw new InvalidArgumentException('You need to specify authentication method!');
        }

        if (null === $authMethod && $password === self::AUTH_ACCESS_TOKEN) {
            $authMethod = $password;
            $password = null;
        }

        $this->getHttpClientBuilder()->removePlugin(Authentication::class);
        $this->getHttpClientBuilder()->addPlugin(new Authentication($tokenOrLogin, $password, $authMethod));
    }

    public function __call(string $name, array $args): AbstractApi
    {
        try {
            return $this->api($name);
        } catch (InvalidArgumentException $e) {
            throw new BadMethodCallException(sprintf('Undefined method called: "%s"', $name), $e->getCode(), $e);
        }
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }
}
