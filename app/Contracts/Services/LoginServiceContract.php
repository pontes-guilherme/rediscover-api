<?php

namespace App\Contracts\Services;

use App\Models\User;
use Illuminate\Http\Request;

interface LoginServiceContract
{
    public function getLoggedUser(): ?User;

    public function loginAdmin(Request $request): array;

    public function getGithubOauthURI(Request $request): string;

    public function githubAuthCallback(Request $request);

    public function logout(): void;
}
