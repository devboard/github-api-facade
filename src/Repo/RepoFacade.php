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

    public function fetchAllBranches();

    public function fetchAllBranchNames();

    public function fetchAllTags();

    public function fetchAllTagNames();

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

    public function fetchAllPullRequests();

    public function fetchAllMilestones();

    public function fetchAllIssues();
}
