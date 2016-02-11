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
     * @return array|mixed
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
     * @return array|mixed
     */
    public function fetchAllIssues()
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

    private function getMilestonesApi()
    {
        return $this->getIssueApi()->milestones();
    }
}
