<?php

namespace App\Services;

use App\Contracts\Services\LoginServiceContract;
use App\Enums\UserTypesEnum;
use App\Exceptions\Auth\UnauthorizedLoginException;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class LoginService implements LoginServiceContract
{
    public function getLoggedUser(): ?User
    {
        return User::first(auth()->user()->id);
    }

    /**
     * @throws UnauthorizedLoginException
     */
    public function loginAdmin(Request $request): array
    {
        return $this->loginWithToken($request, UserTypesEnum::ADMIN);
    }

    public function logout(): void
    {
        auth()->user()->tokens()->delete();

        auth()->guard('web')->logout();
    }

    /**
     * @throws UnauthorizedLoginException
     */
    private function loginWithToken(Request $request, UserTypesEnum $userType): array
    {
        $user = $this->attemptLogin($request, $userType);

        try {
            $this->pruneUserTokens($user);
        } catch (Exception) {
        }

        $token = $user->createToken($request->userAgent() . '_' . $request->ip())->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    /**
     * @return User The user that logged in
     *
     * @throws UnauthorizedLoginException
     */
    private function attemptLogin(Request $request, UserTypesEnum $userType): User
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        $credentials['email'] = strtolower($credentials['email']);

        $user = User::where('email', $credentials['email'])->firstOr(function () {
            throw new UnauthorizedLoginException('User does not exist');
        });

        if ($user->user_type->value !== $userType->value) {
            throw new UnauthorizedLoginException('User type incorrect');
        }

        if (!auth()->attempt($credentials, $remember)) {
            throw new UnauthorizedLoginException('Incorrect credentials');
        }

        return $user;
    }

    private function pruneUserTokens(User $user): void
    {
        $user->tokens()->delete();
    }
}
