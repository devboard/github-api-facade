<?php

namespace spec\DevBoardLib\GithubApiFacade\Client;

use DevBoardLib\GithubApiFacade\Auth\GithubAccessToken;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class KnpLabsClientFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoardLib\GithubApiFacade\Client\KnpLabsClientFactory');
        $this->shouldHaveType('DevBoardLib\GithubApiFacade\Client\ClientFactory');
    }

    public function it_will_return_token_authenticated_github_client(GithubAccessToken $user)
    {
        $this->createTokenAuthenticatedClient($user)
            ->shouldReturnAnInstanceOf('Github\Client');
    }
    public function it_will_return_unauthenticated_github_client()
    {
        $this->createUnauthenticatedClient()
            ->shouldReturnAnInstanceOf('Github\Client');
    }
}
