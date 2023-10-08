<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Resources\TechnologyResource;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TechnologiesController extends BaseController
{
    public function index(): AnonymousResourceCollection
    {
        return TechnologyResource::collection(Technology::all());
    }
}
