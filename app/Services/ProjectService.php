<?php

namespace App\Services;

use App\Contracts\Services\ProjectServiceContract;
use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProjectService implements ProjectServiceContract
{
    public function fetchWithQueryBuilder(bool $paginate = true): LengthAwarePaginator|Collection
    {
        $query = QueryBuilder::for(Project::class)
            ->allowedFilters(['name', AllowedFilter::scope('search')])
            ->allowedSorts(['id', 'name', 'repository_url'])
            ->defaultSort('id');

        if ($paginate) {
            return $query->paginate(request('per_page') ?? 10);
        }

        return $query->get();
    }

    public function fetch(): Collection
    {
        return Project::with('tags', 'technologies')->get();
    }

    public function get(int $id): Project
    {
        return Project::findOrFail($id);
    }

    public function store(array $data): Project
    {
        $project = Project::create($data);

        $this->syncTags($project, $data['tags']);
        $this->syncTechnologies($project, $data['technologies']);

        return $project;
    }

    public function delete(int $id): void
    {
        $model = $this->get($id);
        $model->delete();
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
