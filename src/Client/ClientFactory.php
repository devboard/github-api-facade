<?php
namespace DevBoardLib\GithubApiFacade\Client;

use DevBoardLib\GithubApiFacade\Auth\GithubAccessToken;

/**
 * Interface ClientFactory.
 */
interface ClientFactory
{
    /**
     * @param GithubAccessToken $user
     */
    public function createTokenAuthenticatedClient(GithubAccessToken $user);

    public function createUnauthenticatedClient();
}
