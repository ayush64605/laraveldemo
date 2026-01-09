<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
    use HasFactory;
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
}
