<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Contracts\Services\LoginServiceContract;
use App\Exceptions\Auth\UnauthorizedLoginException;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Common\Auth\LoginRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends BaseController
{
    public function __construct(private readonly LoginServiceContract $loginService)
    {
    }

    /**
     * Login a Admin.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $loginData = $this->loginService->loginAdmin($request);

            return $this->success('', $loginData);
        } catch (UnauthorizedLoginException $e) {
            Log::debug($e, $e->getTrace());

            return $this->error(null, [], Response::HTTP_UNAUTHORIZED);
        } catch (Exception $e) {
            Log::error($e, $e->getTrace());

            return $this->error(null, [], Response::HTTP_INTERNAL_SERVER_ERROR);
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
