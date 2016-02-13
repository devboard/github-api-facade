<?php
namespace DevBoardLib\GithubApiFacade\Repo;

use DevBoardLib\GithubCore\Repo\GithubRepo;
use Github\Client;
use Github\ResultPager;

/**
 * Class PaginatedKnpLabsRepoFacade.
 */
class PaginatedKnpLabsRepoFacade implements RepoFacade
{
    private $client;
    private $githubRepo;

    private $paginator;

    /**
     * PaginatedKnpLabsRepoFacade constructor.
     *
     * @param $client
     * @param $githubRepo
     */
    public function __construct(Client $client, GithubRepo $githubRepo)
    {
        $this->client     = $client;
        $this->githubRepo = $githubRepo;

        $this->paginator = new ResultPager($this->client);
    }

    /**
     * @return array
     */
    public function fetchAllMilestones()
    {
        $parameters = [
            $this->githubRepo->getOwner(),
            $this->githubRepo->getName(),
            ['state' => 'all'],
        ];

        return $this->paginator->fetchAll($this->getMilestonesApi(), 'all', $parameters);
    }

    /**
     * Returns all issues.
     *
     * IMPORTANT:
     * - GitHub API v3 returns both issues and pullRequests together so filtering needs to be done
     * - Pull requests have 'pull_request' key.
     *
     * @return array
     */
    public function fetchAllIssues()
    {
        $results = [];

        foreach ($this->fetchAllIssuesAndPullRequests() as $result) {
            if (!array_key_exists('pull_request', $result)) {
                $results[] = $result;
            }
        }

        return $results;
    }

    /**
     * @return array
     */
    public function fetchAllIssuesAndPullRequests()
    {
        $parameters = [
            $this->githubRepo->getOwner(),
            $this->githubRepo->getName(),
            ['state' => 'all'],
        ];

        return $this->paginator->fetchAll($this->getIssueApi(), 'all', $parameters);
    }

    /**
     * @return \Github\Api\ApiInterface
     */
    private function getIssueApi()
    {
        return $this->client->api('issues');
    }

    /**
     * @return \Github\Api\Issue\Milestones
     */
    private function getMilestonesApi()
    {
        return $this->getIssueApi()->milestones();
    }
}
