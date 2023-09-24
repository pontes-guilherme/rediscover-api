<?php

namespace App\Contracts\Services;

use App\Models\User;
use Illuminate\Http\Request;

interface LoginServiceContract
{
    public function getLoggedUser(): ?User;

    public function loginAdmin(Request $request): array;

    public function logout(): void;
}
