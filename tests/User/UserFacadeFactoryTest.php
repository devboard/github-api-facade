<?php

namespace tests\DevBoardLib\GithubApiFacade\User;

use DevBoardLib\GithubApiFacade\Client\KnpLabsClientFactory;
use DevBoardLib\GithubApiFacade\User\UserFacadeFactory;
use Mockery as m;

/**
 * Class UserFacadeFactoryTest.
 */
class UserFacadeFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $target = new UserFacadeFactory(new KnpLabsClientFactory());

        $result = $target->create($this->provideTestUser());

        self::assertInstanceOf('DevBoardLib\GithubApiFacade\User\PaginatedKnpLabsUserFacade', $result);
    }

    /**
     * @return \DevBoardLib\GithubApiFacade\Auth\GithubAccessToken
     */
    private function provideTestUser()
    {
        $user = m::mock('DevBoardLib\GithubApiFacade\Auth\GithubAccessToken');
        $user->shouldReceive('getGithubAccessToken')->andReturn(getenv('GITHUB_ACCESS_TOKEN'));

        return $user;
    }
}
