<?php

namespace App\Contracts\Services;

use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ProjectServiceContract
{
    public function fetchWithQueryBuilder(bool $paginate = true): LengthAwarePaginator|Collection;

    public function get(int $id): Project;

    public function store(array $data): Project;

    public function delete(int $id): void;
}
