<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
    ];

    // For many client
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    // For user/ Title
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // For Company Category
    public function getCategory()
    {
        return $this->hasOne('App\Models\CompanyCategory', 'id', 'company_category_id');
    }

    // For Post Details
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

}
