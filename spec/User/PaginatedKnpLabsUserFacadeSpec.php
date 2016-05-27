<?php

declare (strict_types = 1);
namespace spec\DevBoardLib\GithubApiFacade\User;

use Github\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PaginatedKnpLabsUserFacadeSpec extends ObjectBehavior
{
    public function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoardLib\GithubApiFacade\User\PaginatedKnpLabsUserFacade');
        $this->shouldHaveType('DevBoardLib\GithubApiFacade\User\UserFacade');
    }
}
