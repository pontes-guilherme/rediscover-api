<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Services\ProjectServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProjectsController extends Controller
{
    public function __construct(private readonly ProjectServiceContract $service)
    {
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return ProjectResource::collection(
            $this->service->fetchWithQueryBuilder(!$request->boolean('no_pagination'))
        );
    }

    public function show(Request $request, string $id): ProjectResource
    {
        return ProjectResource::make(
            $this->service->get($id)->load('tags', 'technologies')
        );
    }

    public function destroy(Request $request, int $id): Response
    {
        $this->service->delete($id);

        return response()->noContent();
    }
}
