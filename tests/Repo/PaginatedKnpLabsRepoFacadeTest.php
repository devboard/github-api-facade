<?php
namespace tests\DevBoardLib\GithubApiFacade\Repo;

use DevBoardLib\GithubApiFacade\Client\KnpLabsClientFactory;
use DevBoardLib\GithubApiFacade\Repo\PaginatedKnpLabsRepoFacade;
use Mockery as m;

/**
 * Class PaginatedKnpLabsRepoFacadeTest.
 */
class PaginatedKnpLabsRepoFacadeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @group GithubIntegration
     * @group Live
     */
    public function testFetchAllMilestones()
    {
        $target = new PaginatedKnpLabsRepoFacade(
            $this->getTokenAuthenticatedApiClient(),
            $this->provideTestRepo()
        );

        self::assertCount(4, $target->fetchAllMilestones());
    }

    /**
     * @group GithubIntegration
     * @group Live
     * @group wip
     */
    public function testFetchAllIssues()
    {
        $target = new PaginatedKnpLabsRepoFacade(
            $this->getTokenAuthenticatedApiClient(),
            $this->provideTestRepo()
        );

        self::assertCount(10, $target->fetchAllIssues());
    }

    /**
     * @group GithubIntegration
     * @group Live
     * @group wip
     */
    public function testFetchAllIssuesAndPullRequests()
    {
        $target = new PaginatedKnpLabsRepoFacade(
            $this->getTokenAuthenticatedApiClient(),
            $this->provideTestRepo()
        );

        self::assertCount(12, $target->fetchAllIssuesAndPullRequests());
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
     * @return \DevBoardLib\GithubCore\Repo\GithubRepo
     */
    private function provideTestRepo()
    {
        $githubRepo = m::mock('DevBoardLib\GithubCore\Repo\GithubRepo');
        $githubRepo->shouldReceive('getOwner')->andReturn('devboard');
        $githubRepo->shouldReceive('getName')->andReturn('test-hitman');

        return $githubRepo;
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
