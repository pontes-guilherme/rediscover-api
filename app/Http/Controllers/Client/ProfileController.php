<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Resources\UserResource;

class ProfileController extends BaseController
{
    public function show()
    {
        return UserResource::make(auth()->user());
    }
}
