<?php

namespace App\Http\Controllers\Client;

use App\Contracts\Services\ProjectServiceContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Client\Project\StoreProjectRequest;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProjectsController extends BaseController
{
    public function __construct(private readonly ProjectServiceContract $service)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return ProjectResource::collection(
            $this->service->fetch()
        );
    }

    public function show(int $id): ProjectResource
    {
        return ProjectResource::make(
            $this->service->get($id)->load('tags', 'technologies')
        );
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
