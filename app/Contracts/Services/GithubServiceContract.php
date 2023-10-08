<?php

namespace App\Contracts\Services;

interface GithubServiceContract
{
    public function fetchRepoInfo($url): array;

    public function fetchRepoBasicInfo(string $owner, string $repo);

    public function fetchRepoLanguages(string $owner, string $repo);

    public function fetchRepoLastCommits(string $owner, string $repo);

    public function fetchRepoLastContributors(string $owner, string $repo);
}
