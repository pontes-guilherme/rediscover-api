<?php

namespace App\Services;

use App\Contracts\Services\ProjectServiceContract;
use App\Models\Project;

class ProjectService implements ProjectServiceContract
{
    public function store(array $data): Project
    {
        $project = Project::create($data);

        $project->tags()->sync($data['tags']);
        $project->technologies()->sync($data['technologies']);

        return $project;
    }
}
