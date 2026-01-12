<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projectuser extends Model
{
    protected $table = 'projectusers';
    protected $fillable = [
        'project_id',
        'name',
        'email'
    ];

    public function projects()
    {
        return $this->hasOne(Project::class, 'project_id');
    }
}
