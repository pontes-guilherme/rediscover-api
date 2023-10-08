<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GithubRepositoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['id'],
            'commits' => $this['commits'],
            'contributors' => $this['contributors'],
            'description' => $this['description'],
            'languages' => $this['languages'],
            'name' => $this['name'],
            'stargazers_count' => $this['stargazers_count'],
        ];
    }
}
