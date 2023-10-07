<?php

namespace App\Services;

use App\Contracts\Services\GithubServiceContract;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;

class GithubService implements GithubServiceContract
{
    private Client $httpClient;
    private string $token;

    public function __construct()
    {
        $this->httpClient = new Client(['base_uri' => 'https://api.github.com/']);
        $this->token = config('services.github.token');
    }

    /**
     * @throws Exception
     */
    public function fetchRepoInfo($url): array
    {
        if (!$this->isUrlValid($url)) {
            throw new Exception('Invalid URL');
        }

        $cacheKey = md5($url);

        return Cache::remember($cacheKey, now()->addHour(1), function () use ($url) {
            [$owner, $repo] = $this->parseUrl($url);

            $basicInfo = $this->fetchRepoBasicInfo($owner, $repo);
            $languages = $this->fetchRepoLanguages($owner, $repo);
            $lastCommits = $this->fetchRepoLastCommits($owner, $repo);
            $lastContributors = $this->fetchRepoLastContributors($owner, $repo);

            return [
                'id' => $basicInfo['id'],
                'name' => $basicInfo['name'],
                'description' => $basicInfo['description'],
                'stargazers_count' => $basicInfo['stargazers_count'],
                'languages' => $languages,
                'owner_avatar_url' => $basicInfo['owner']['avatar_url'],
                'commits' => $lastCommits,
                'contributors' => $lastContributors,
            ];
        });
    }

    /**
     * @throws GuzzleException
     */
    public function fetchRepoBasicInfo(string $owner, string $repo)
    {
        $url = "repos/{$owner}/{$repo}";
        return $this->request($url);
    }

    /**
     * @throws GuzzleException
     */
    public function fetchRepoLanguages(string $owner, string $repo)
    {
        $url = "repos/{$owner}/{$repo}/languages";
        return $this->request($url);
    }

    /**
     * @throws GuzzleException
     */
    public function fetchRepoLastCommits(string $owner, string $repo)
    {
        $url = "repos/{$owner}/{$repo}/commits";
        return $this->request($url, 'GET', ['query' => ['per_page' => 3]]);
    }

    /**
     * @throws GuzzleException
     */
    public function fetchRepoLastContributors(string $owner, string $repo)
    {
        $url = "repos/{$owner}/{$repo}/contributors";
        return $this->request($url, 'GET', ['query' => ['per_page' => 3]]);
    }

    private function isUrlValid(string $url): bool
    {
        $urlRegex = '/^(https?:\/\/)?(www\.)?github\.com\/[a-zA-Z0-9_-]+\/[a-zA-Z0-9_-]+(\/)?$/';

        if (!preg_match($urlRegex, $url)) {
            return false;
        }

        [$owner, $repo] = $this->parseUrl($url);

        try {
            $response = $this->httpClient->head("repos/$owner/$repo");

            if ($response->getStatusCode() === 200) {
                return true;
            }
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() === 404) {
                return false;
            }

            logger()->error($e->getMessage());
        }

        return false;
    }

    private function parseUrl(string $url): array
    {
        $url = parse_url($url);
        $path = explode('/', $url['path']);
        $owner = $path[1];
        $repo = $path[2];

        return [$owner, $repo];
    }

    private function client(): Client
    {
        return $this->httpClient;
    }

    /**
     * @throws GuzzleException
     */
    private function request(string $uri, string $method = 'GET', array $options = [])
    {
        $headers = $this->getHeaders();

        if (isset($options['headers'])) {
            $headers = array_merge($headers, $options['headers']);
        }

        $response = $this->client()->request($method, $uri, $headers);

        return json_decode($response->getBody(), true);
    }

    private function getHeaders(): array
    {
        return [
            'Authorization' => 'token ' . $this->token,
            'Accept' => 'application/vnd.github.v3+json',
        ];
    }
}
