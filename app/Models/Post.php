<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'job_title',
        'job_level',
        'vacancy_count',
        'employment_type',
        'district',
        'job_location',
        'salary',
        'deadline',
        'education_level',
        'experience',
        'skills',
        'specifications',
        'status'
    ];

    //user post pivot for savedJobs
    public function users()
    {
        return $this->hasMany('App\Models\User', 'App\Model\Company');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function deadlineTimestamp()
    {
        return Carbon::parse($this->deadline)->timestamp;
    }

    public function remainingDays()
    {
        $deadline = $this->deadline;
        $timestamp = Carbon::parse($deadline)->timestamp - Carbon::now()->timestamp;
        return $timestamp;
    }

    public function getSkills()
    {
        return explode(',', $this->skills);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
