<?php

namespace App\Http\Controllers\Client;

use App\Contracts\Services\ProjectServiceContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Client\Project\StoreProjectRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProjectsController extends BaseController
{
    public function __construct(private readonly ProjectServiceContract $service)
    {
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        $this->service->store($request->validated());

        return $this->success(
            'Project created successfully.',
            [],
            Response::HTTP_CREATED
        );
    }
}
