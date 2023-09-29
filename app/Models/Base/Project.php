<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Project
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string $description
 * @property string $repository_url
 * @property string $repository_id
 * @property string|null $abandonment_reason
 * @property string|null $project_future
 * @property string|null $project_abandonment_status
 * @property string|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property User|null $user
 * @property Collection|Tag[] $tags
 * @property Collection|Technology[] $technologies
 *
 * @package App\Models\Base
 */
class Project extends Model
{
    use SoftDeletes;

    protected $table = 'projects';

    protected $casts = [
        'user_id' => 'int'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'projects_tags')
            ->withPivot('id')
            ->withTimestamps();
    }

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'projects_technologies')
            ->withPivot('id')
            ->withTimestamps();
    }
}
