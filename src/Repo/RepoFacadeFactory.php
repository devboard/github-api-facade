<?php

namespace DevBoardLib\GithubApiFacade\Repo;

use DevBoardLib\GithubApiFacade\Auth\GithubAccessToken;
use DevBoardLib\GithubApiFacade\Client\ClientFactory;
use DevBoardLib\GithubCore\Repo\GithubRepo;

/**
 * Class RepoFacadeFactory.
 */
class RepoFacadeFactory
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
     * @param GithubRepo        $githubRepo
     * @param GithubAccessToken $user
     *
     * @return PaginatedKnpLabsRepoFacade
     */
    public function create(GithubRepo $githubRepo, GithubAccessToken $user)
    {
        $client = $this->clientFactory->createTokenAuthenticatedClient($user);

        return new PaginatedKnpLabsRepoFacade($client, $githubRepo);
    }
}
