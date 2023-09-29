<?php

namespace App\Models;

use App\Models\Base\Tag as BaseTag;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends BaseTag
{
    use HasFactory;

	protected $fillable = [
		'name'
	];
}
