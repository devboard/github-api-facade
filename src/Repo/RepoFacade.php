<?php
namespace DevBoardLib\GithubApiFacade\Repo;

/**
 * Interface RepoFacade.
 */
interface RepoFacade
{
    public function fetchDetails();

    /**
     * @param $branchName
     *
     * @return mixed
     */
    public function fetchBranch($branchName);

    /** @return array */
    public function fetchAllBranches();

    /** @return array */
    public function fetchAllTags();

    /**
     * @param $commitSha
     *
     * @return mixed
     */
    public function fetchCommit($commitSha);

    /**
     * @param $commitSha
     *
     * @return mixed
     */
    public function fetchCommitStatus($commitSha);

    /**
     * @param $commitSha
     *
     * @return mixed
     */
    public function fetchCommitStatuses($commitSha);

    /** @return array */
    public function fetchAllPullRequests();

    /** @return array */
    public function fetchAllMilestones();

    /** @return array */
    public function fetchAllIssues();
}
