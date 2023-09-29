<?php

namespace App\Models;

use App\Models\Base\Project as BaseProject;

class Project extends BaseProject
{
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
}
