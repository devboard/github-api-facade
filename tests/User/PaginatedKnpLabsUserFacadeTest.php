<?php

declare (strict_types = 1);
namespace tests\DevBoardLib\GithubApiFacade\User;

use DevBoardLib\GithubApiFacade\Client\KnpLabsClientFactory;
use DevBoardLib\GithubApiFacade\User\PaginatedKnpLabsUserFacade;
use Mockery as m;

/**
 * Class PaginatedKnpLabsUserFacadeTest.
 */
class PaginatedKnpLabsUserFacadeTest extends \PHPUnit_Framework_TestCase
{
    private $facade;

    public function setUp()
    {
        parent::setUp();

        $this->facade = new PaginatedKnpLabsUserFacade(
            $this->getTokenAuthenticatedApiClient()
        );
    }

    /**
     * @group GithubIntegration
     * @group Live
     */
    public function testFetchAllAccessibleRepos()
    {
        self::assertCount(5, $this->facade->fetchAllAccessibleRepos());
    }

    /**
     * @return \Github\Client
     */
    private function getTokenAuthenticatedApiClient()
    {
        $factory = new KnpLabsClientFactory();

        return $factory->createTokenAuthenticatedClient($this->provideTestUser());
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
