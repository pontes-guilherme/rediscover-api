<?php

namespace App\Http\Controllers\Client\Auth;

use App\Contracts\Services\LoginServiceContract;
use App\Exceptions\Auth\UnauthorizedLoginException;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Common\Auth\LoginRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class GithubAuthController extends BaseController
{
    public function __construct(private readonly LoginServiceContract $loginService)
    {
    }

    /**
     * Login a Admin.
     */
    public function getGithubOauthURI(Request $request): JsonResponse
    {
        $url = $this->loginService->getGithubOauthURI($request);

        return $this->success('', [
            'url' => $url,
        ]);
    }

    public function callback(Request $request)
    {
        try {
            $token = $this->loginService->githubAuthCallback($request);

            return view('github-auth-callback', [
                'token' => $token,
            ]);
        } catch (Exception $e) {
            return view('github-error-callback', [
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Logout a Admin.
     */
    public function logout(): JsonResponse
    {
        $this->loginService->logout();

        return $this->success();
    }
}
