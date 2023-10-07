<?php

namespace App\Services;

use App\Contracts\Services\ProjectServiceContract;
use App\Models\Project;

class ProjectService implements ProjectServiceContract
{
    public function store(array $data): Project
    {
        $project = Project::create($data);

        $this->syncTags($project, $data['tags']);
        $this->syncTechnologies($project, $data['technologies']);

        return $project;
    }

    private function syncTags(Project $project, array $tags): void
    {
        $project->tags()->sync(
            collect($tags)->pluck('id')->toArray()
        );
    }

    private function syncTechnologies(Project $project, array $technologies): void
    {
        $project->technologies()->sync(
            collect($technologies)->pluck('id')->toArray()
        );
    }
}
