<?php

namespace App\Contracts\Services;

use App\Models\Project;

interface ProjectServiceContract
{
    public function store(array $data): Project;
}
