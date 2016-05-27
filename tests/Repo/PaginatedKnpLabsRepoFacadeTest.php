<?php

declare (strict_types = 1);
namespace tests\DevBoardLib\GithubApiFacade\Repo;

use DevBoardLib\GithubApiFacade\Client\KnpLabsClientFactory;
use DevBoardLib\GithubApiFacade\Repo\PaginatedKnpLabsRepoFacade;
use Mockery as m;

/**
 * Class PaginatedKnpLabsRepoFacadeTest.
 */
class PaginatedKnpLabsRepoFacadeTest extends \PHPUnit_Framework_TestCase
{
    private $facade;

    public function setUp()
    {
        parent::setUp();

        $this->facade = new PaginatedKnpLabsRepoFacade(
            $this->getTokenAuthenticatedApiClient(),
            $this->provideTestRepo()
        );
    }

    /**
     * @group GithubIntegration
     * @group Live
     */
    public function testFetchRepoDetails()
    {
        $result = $this->facade->fetchDetails();

        self::assertSame($this->provideTestRepo()->getFullName(), $result['full_name']);
    }

    /**
     * @group GithubIntegration
     * @group Live
     */
    public function testFetchBranch()
    {
        $result = $this->facade->fetchBranch('master');

        self::assertSame('master', $result['name']);
    }

    /**
     * @group GithubIntegration
     * @group Live
     */
    public function testFetchAllBranches()
    {
        self::assertCount(7, $this->facade->fetchAllBranches());
    }

    /**
     * @group GithubIntegration
     * @group Live
     */
    public function testFetchAllBranchNames()
    {
        self::assertCount(7, $this->facade->fetchAllBranchNames());
    }

    /**
     * @group GithubIntegration
     * @group Live
     */
    public function testFetchAllTags()
    {
        self::assertCount(1, $this->facade->fetchAllTags());
    }

    /**
     * @group GithubIntegration
     * @group Live
     */
    public function testFetchAllTagNames()
    {
        self::assertCount(1, $this->facade->fetchAllTagNames());
    }

    /**
     * @group GithubIntegration
     * @group Live
     */
    public function testFetchCommit()
    {
        $result = $this->facade->fetchCommit('db911bd3a3dd8bb2ad9eccbcb0a396595a51491d');

        self::assertSame('db911bd3a3dd8bb2ad9eccbcb0a396595a51491d', $result['sha']);
    }

    /**
     * @group GithubIntegration
     * @group Live
     */
    public function testFetchCommitStatuses()
    {
        self::assertCount(27, $this->facade->fetchCommitStatuses('db911bd3a3dd8bb2ad9eccbcb0a396595a51491d'));
    }

    /**
     * @group GithubIntegration
     * @group Live
     */
    public function testFetchCommitStatus()
    {
        $result = $this->facade->fetchCommitStatus('db911bd3a3dd8bb2ad9eccbcb0a396595a51491d');
        self::assertSame(
            'https://api.github.com/repos/devboard/test-hitman/commits/db911bd3a3dd8bb2ad9eccbcb0a396595a51491d',
            $result['commit_url']
        );
    }

    /**
     * @group GithubIntegration
     * @group Live
     */
    public function testFetchAllPullRequests()
    {
        self::assertCount(2, $this->facade->fetchAllPullRequests());
    }

    /**
     * @group GithubIntegration
     * @group Live
     */
    public function testFetchAllMilestones()
    {
        self::assertCount(4, $this->facade->fetchAllMilestones());
    }

    /**
     * @group GithubIntegration
     * @group Live
     */
    public function testFetchAllIssues()
    {
        self::assertCount(10, $this->facade->fetchAllIssues());
    }

    /**
     * @group GithubIntegration
     * @group Live
     */
    public function testFetchAllIssuesAndPullRequests()
    {
        self::assertCount(12, $this->facade->fetchAllIssuesAndPullRequests());
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
        $githubRepo->shouldReceive('getFullName')->andReturn('devboard/test-hitman');

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
