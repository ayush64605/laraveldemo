<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projectcategory extends Model
{
    public function projects()
    {
        return $this->hasMany(Project::class, 'project_category');
    }
}
