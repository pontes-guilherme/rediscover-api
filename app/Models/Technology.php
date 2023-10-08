<?php

namespace App\Models;

use App\Models\Base\Technology as BaseTechnology;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Technology extends BaseTechnology
{
    use HasFactory;

	protected $fillable = [
		'name'
	];
}
