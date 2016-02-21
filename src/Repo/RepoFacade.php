<?php
namespace DevBoardLib\GithubApiFacade\Repo;

/**
 * Interface RepoFacade.
 */
interface RepoFacade
{
    public function fetchDetails();

    public function fetchBranch($branchName);

    public function fetchAllBranches();

    public function fetchAllBranchNames();

    public function fetchAllTagNames();

    public function fetchCommit($commitSha);

    public function fetchCommitStatus($commitSha);

    public function fetchCommitStatuses($commitSha);

    public function fetchAllPullRequests();

    public function fetchAllMilestones();

    public function fetchAllIssues();
}
