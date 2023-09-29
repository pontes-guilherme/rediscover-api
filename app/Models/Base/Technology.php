<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Technology
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|Project[] $projects
 *
 * @package App\Models\Base
 */
class Technology extends Model
{
	use SoftDeletes;
	protected $table = 'technologies';

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'projects_technologies')
            ->withPivot('id')
            ->withTimestamps();
    }
}
