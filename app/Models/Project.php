<?php

namespace App\Models;

use App\Models\Base\Project as BaseProject;
use App\Models\Concerns\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Project extends BaseProject
{
    use Searchable;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'repository_url',
        'repository_id',
        'abandonment_reason',
        'project_future',
        'project_abandonment_status',
        'status'
    ];

    protected $searchableFields = [
        'name',
        'description',
        'repository_url',
        'repository_id',
        'abandonment_reason',
        'project_future',
    ];

    protected $appends = [
        'repository_owner',
        'repository_name',
    ];

    public function repositoryOwner(): Attribute
    {
        [$owner,] = $this->extractOwnerAndNameFromRepoUrl($this->repository_url);

        return Attribute::make(
            get: fn(mixed $value, array $attributes) => $owner,
        );
    }

    public function repositoryName(): Attribute
    {
        [, $repo] = $this->extractOwnerAndNameFromRepoUrl($this->repository_url);

        return Attribute::make(
            get: fn(mixed $value, array $attributes) => $repo,
        );
    }

    private function extractOwnerAndNameFromRepoUrl(string $url): array
    {
        $url = parse_url($url);
        $path = explode('/', $url['path']);
        $owner = $path[1];
        $repo = $path[2];

        return [$owner, $repo];
    }
}
