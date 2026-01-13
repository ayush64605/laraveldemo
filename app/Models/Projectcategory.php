<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Projectcategory extends Model
{
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'project_category');
    }

    public function latestProject(): HasOne
    {
        return $this->hasOne(Project::class, 'project_category')->latestOfMany();
    }

    public function largestProject(): HasOne
    {
        return $this->hasOne(Project::class, 'project_category')->ofMany('budget', 'max');
    }

    public function getTask(): HasOneThrough
    {
        return $this->hasOneThrough(Task::class, Project::class, 'project_category');
    }
}
