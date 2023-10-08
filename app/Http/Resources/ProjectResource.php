<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'description' => $this->description,
            'repository_url' => $this->repository_url,
            'repository_id' => $this->repository_id,
            'abandonment_reason' => $this->abandonment_reason,
            'project_future' => $this->project_future,
            'project_abandonment_status' => $this->project_abandonment_status,
            'status' => $this->status,
            'repository_owner' => $this->repository_owner,
            'repository_name' => $this->repository_name,
        ];
    }
}
