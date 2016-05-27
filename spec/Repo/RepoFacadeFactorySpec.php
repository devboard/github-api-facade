<?php

declare (strict_types = 1);
namespace spec\DevBoardLib\GithubApiFacade\Repo;

use DevBoardLib\GithubApiFacade\Auth\GithubAccessToken;
use DevBoardLib\GithubApiFacade\Client\ClientFactory;
use DevBoardLib\GithubCore\Repo\GithubRepo;
use Github\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RepoFacadeFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoardLib\GithubApiFacade\Repo\RepoFacadeFactory');
    }

    public function let(ClientFactory $clientFactory)
    {
        $this->beConstructedWith($clientFactory);
    }

    public function it_will_create_repo_facade($clientFactory, GithubRepo $githubRepo, GithubAccessToken $user, Client $client)
    {
        $clientFactory->createTokenAuthenticatedClient($user)->willReturn($client);
        $this->create($githubRepo, $user)
            ->shouldReturnAnInstanceOf('DevBoardLib\GithubApiFacade\Repo\PaginatedKnpLabsRepoFacade');
    }
}
