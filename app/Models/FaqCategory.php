<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FaqCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'status'];

    // Mutator to set the slug with timestamp
    public function setSlugAttribute()
    {
        $name = $this->attributes['name'];
        $lowerStr = Str::slug($name, '-');
        $checkLowerStr = $this::where('slug', $lowerStr)->first();
        $this->attributes['slug'] = is_null($checkLowerStr) ? $lowerStr : (Str::slug($name, '-') . '-' . time());
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class, 'faq_category_id');
    }
}
