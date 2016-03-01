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
     * Fetches GithubRepo details.
     *
     * @return array
     */
    public function fetchDetails()
    {
        return $this->getRepoApi()
            ->show(
                $this->githubRepo->getOwner(),
                $this->githubRepo->getName()
            );
    }

    /**
     * Fetches GithubBranch details.
     *
     * @param $branchName
     *
     * @return array
     */
    public function fetchBranch($branchName)
    {
        return $this->getRepoApi()
            ->branches(
                $this->githubRepo->getOwner(),
                $this->githubRepo->getName(),
                $branchName
            );
    }

    /** @return array */
    public function fetchAllBranches()
    {
        $results = [];

        foreach ($this->fetchAllBranchNames() as $branchData) {
            $results[] = $this->fetchBranch($branchData['name']);
        }

        return $results;
    }

    /** @return array */
    public function fetchAllBranchNames()
    {
        $parameters = [
            $this->githubRepo->getOwner(),
            $this->githubRepo->getName(),
        ];

        return $this->paginator->fetchAll($this->getRepoApi(), 'branches', $parameters);
    }

    /** @return array */
    public function fetchAllTags()
    {
        $results = [];

        foreach ($this->fetchAllTagNames() as $tagData) {
            $tagData['commit'] = $this->fetchCommit($tagData['commit']['sha']);
            $results[]         = $tagData;
        }

        return $results;
    }

    /** @return array */
    public function fetchAllTagNames()
    {
        $parameters = [
            $this->githubRepo->getOwner(),
            $this->githubRepo->getName(),
        ];

        return $this->paginator->fetchAll($this->getRepoApi(), 'tags', $parameters);
    }

    /**
     * Fetches GithubCommit details.
     *
     * @param $commitSha
     *
     * @return array
     */
    public function fetchCommit($commitSha)
    {
        return $this->getRepoApi()->commits()
            ->show(
                $this->githubRepo->getOwner(),
                $this->githubRepo->getName(),
                $commitSha
            );
    }

    /**
     * Fetches GithubCommit status.
     *
     * @param $commitSha
     *
     * @return array
     */
    public function fetchCommitStatus($commitSha)
    {
        return $this->getRepoApi()->statuses()
            ->combined(
                $this->githubRepo->getOwner(),
                $this->githubRepo->getName(),
                $commitSha
            );
    }

    /**
     * Fetches list of GithubCommit statuses.
     *
     * @param $commitSha
     *
     * @return array
     */
    public function fetchCommitStatuses($commitSha)
    {
        return $this->getRepoApi()->statuses()
            ->show(
                $this->githubRepo->getOwner(),
                $this->githubRepo->getName(),
                $commitSha
            );
    }

    /** @return array */
    public function fetchAllPullRequests()
    {
        $parameters = [
            $this->githubRepo->getOwner(),
            $this->githubRepo->getName(),
            ['state' => 'all'],
        ];

        return $this->paginator->fetchAll($this->getPullRequestApi(), 'all', $parameters);
    }

    /** @return array */
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

    /** @return array */
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
    private function getRepoApi()
    {
        return $this->client->api('repository');
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

    /**
     * @return \Github\Api\PullRequest
     */
    private function getPullRequestApi()
    {
        return $this->client->api('pull_requests');
    }
}
