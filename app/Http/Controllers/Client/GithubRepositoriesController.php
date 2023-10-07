<?php

namespace App\Http\Controllers\Client;

use App\Contracts\Services\GithubServiceContract;
use App\Http\Controllers\BaseController;
use App\Http\Resources\GithubRepositoryResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GithubRepositoriesController extends BaseController
{
    public function __construct(private readonly GithubServiceContract $githubService)
    {
    }

    public function get(Request $request): GithubRepositoryResource|JsonResponse
    {
        $url = $request->input('url');

        if (empty($url)) {
            return response()->json([
                'message' => 'URL is required',
            ], 400);
        }

        try {
            $repoInfo = $this->githubService->fetchRepoInfo($url);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }

        return GithubRepositoryResource::make($repoInfo);
    }
}
