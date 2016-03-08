<?php

namespace DevBoardLib\GithubApiFacade\User;

use Github\Client;
use Github\ResultPager;

/**
 * Class PaginatedKnpLabsUserFacade.
 */
class PaginatedKnpLabsUserFacade implements UserFacade
{
    /** @var  Client */
    private $client;
    /** @var ResultPager */
    private $paginator;

    /**
     * PaginatedKnpLabsUserFacade constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client    = $client;
        $this->paginator = new ResultPager($this->client);
    }

    /**
     * @return array|mixed
     */
    public function fetchAllAccessibleRepos()
    {
        return $this->paginator->fetchAll($this->getMeApi(), 'repositories', ['type' => 'all']);
    }

    /**
     * @return \Github\Api\ApiInterface
     */
    private function getMeApi()
    {
        return $this->client->api('me');
    }
}
