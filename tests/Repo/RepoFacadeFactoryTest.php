<?php
namespace tests\DevBoardLib\GithubApiFacade\Repo;

use DevBoardLib\GithubApiFacade\Client\KnpLabsClientFactory;
use DevBoardLib\GithubApiFacade\Repo\RepoFacadeFactory;
use Mockery as m;

/**
 * Class RepoFacadeFactoryTest.
 */
class RepoFacadeFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $target = new RepoFacadeFactory(new KnpLabsClientFactory());

        $result = $target->create($this->provideTestRepo(), $this->provideTestUser());

        self::assertInstanceOf('DevBoardLib\GithubApiFacade\Repo\PaginatedKnpLabsRepoFacade', $result);
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
