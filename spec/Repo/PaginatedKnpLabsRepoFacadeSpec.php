<?php
namespace spec\DevBoardLib\GithubApiFacade\Repo;

use DevBoardLib\GithubCore\Repo\GithubRepo;
use Github\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PaginatedKnpLabsRepoFacadeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoardLib\GithubApiFacade\Repo\PaginatedKnpLabsRepoFacade');
        $this->shouldHaveType('DevBoardLib\GithubApiFacade\Repo\RepoFacade');
    }

    public function let(Client $client, GithubRepo $githubRepo)
    {
        $this->beConstructedWith($client, $githubRepo);
    }
}
