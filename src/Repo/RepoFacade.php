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

    public function fetchAllTags();

    public function fetchCommit($commitSha);

    public function fetchCommitStatus($commitSha);

    public function fetchCommitStatuses($commitSha);

    public function fetchAllPullRequests();

    public function fetchAllMilestones();

    public function fetchAllIssues();
}
