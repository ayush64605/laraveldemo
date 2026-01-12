<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Projectcategory extends Model
{
    public function projects()
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
}
