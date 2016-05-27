<?php

declare (strict_types = 1);
namespace DevBoardLib\GithubApiFacade\Client;

use DevBoardLib\GithubApiFacade\Auth\GithubAccessToken;
use Github\Client;

/**
 * Class KnpLabsClientFactory.
 */
class KnpLabsClientFactory implements ClientFactory
{
    /**
     * @param GithubAccessToken $user
     *
     * @return Client
     */
    public function createTokenAuthenticatedClient(GithubAccessToken $user)
    {
        $client = new Client();
        $client->authenticate($user->getGithubAccessToken(), 'null', 'url_token');

        return $client;
    }

    /**
     * @return Client
     */
    public function createUnauthenticatedClient()
    {
        return new Client();
    }
}
