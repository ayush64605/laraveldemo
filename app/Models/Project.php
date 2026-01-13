<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $fillable = [
        'name',
        'project_code',
        'project_key',
        'status',
        'is_featured',
        'priority',
        'progress',
        'budget',
        'project_url',
        'started_at',
        'completed_at',
        'deadline_time',
        'project_type',
        'technologies',
        'description',
        'image',
        'client_name',
        'client_email',
        'client_phone',
        'client_company',
        'client_pan',
        'client_website',
        'client_address'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'progress' => 'integer',
        'budget' => 'float',
        'technologies' => 'array',
        'started_at' => 'date',
        'completed_at' => 'date',
        'deadline_time' => 'datetime',
    ];

    protected $hidden = [
        'client_pan',
    ];

    public function category()
    {
        return $this->belongsTo(Projectcategory::class, 'project_category');
    }

    public function users()
    {
        return $this->hasOne(Projectuser::class, 'project_id', 'id');
    }

    public function latestTask(): HasOne
    {
        return $this->hasOne(Task::class, 'project_id')->latestOfMany();
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_projects', 'project_id', 'employee_id');
    }
}
