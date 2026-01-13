<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'number',
    ];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'employee_projects', 'employee_id', 'project_id');
    }
}
