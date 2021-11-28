<?php

namespace App\Command\Description;

use App\Command\Handler\DummyHandler;
use Evrinoma\FetchBundle\Description\AbstractDescription;
use Evrinoma\FetchBundle\Exception\Description\CommunicationException;
use Evrinoma\FetchBundle\Exception\Description\DescriptionNotValidException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FixerDescription extends AbstractDescription
{
//region SECTION: Fields
    private HttpClientInterface $client;
//endregion Fields

//region SECTION: Constructor
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
//endregion Constructor
//region SECTION: Public

    /**
     * @return array
     * @throws CommunicationException
     */
    public function load(): array
    {
        $response = $this->client->request(
            'GET',
            'http://data.fixer.io/api/latest?access_key=7539b4b41544dd93773c2d1aa9f60311&format=1'
        );

        return json_decode($response->getContent(), true);
    }

    /**
     * @return bool
     * @throws DescriptionNotValidException
     */
    public function configure(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function tag(): string
    {
        return DummyHandler::class;
    }

    public function name(): string
    {
        return 'fixer';
    }
//endregion Public
}