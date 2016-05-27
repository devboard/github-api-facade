<?php

declare (strict_types = 1);
namespace spec\DevBoardLib\GithubApiFacade\User;

use DevBoardLib\GithubApiFacade\Auth\GithubAccessToken;
use DevBoardLib\GithubApiFacade\Client\ClientFactory;
use Github\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserFacadeFactorySpec extends ObjectBehavior
{
    public function let(ClientFactory $clientFactory)
    {
        $this->beConstructedWith($clientFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoardLib\GithubApiFacade\User\UserFacadeFactory');
    }

    public function it_will_create_repo_facade($clientFactory, GithubAccessToken $user, Client $client)
    {
        $clientFactory->createTokenAuthenticatedClient($user)->willReturn($client);
        $this->create($user)
            ->shouldReturnAnInstanceOf('DevBoardLib\GithubApiFacade\User\PaginatedKnpLabsUserFacade');
    }
}
