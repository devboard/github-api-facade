<?php
namespace DevBoardLib\GithubApiFacade\Repo;

/**
 * Interface RepoFacade.
 */
interface RepoFacade
{
    public function fetchAllMilestones();

    public function fetchAllIssues();
}
