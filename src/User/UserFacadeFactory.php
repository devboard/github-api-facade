<?php

namespace DevBoardLib\GithubApiFacade\User;

use DevBoardLib\GithubApiFacade\Auth\GithubAccessToken;
use DevBoardLib\GithubApiFacade\Client\ClientFactory;

/**
 * Class UserFacadeFactory.
 */
class UserFacadeFactory
{
    private $clientFactory;

    /**
     * RepoFacadeFactory constructor.
     *
     * @param $clientFactory
     */
    public function __construct(ClientFactory $clientFactory)
    {
        $this->clientFactory = $clientFactory;
    }

    /**
     * @param GithubAccessToken $user
     *
     * @return PaginatedKnpLabsUserFacade
     */
    public function create(GithubAccessToken $user)
    {
        $client = $this->clientFactory->createTokenAuthenticatedClient($user);

        return new PaginatedKnpLabsUserFacade($client);
    }
}
