<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * use trait of the package that make translate
     */
    use Translatable;

    /**
     * relations to eager load o every query
     * @var array
     */
    protected $with = ['translations'];

    /**
     * the attributes that will translated
     * @var string[]
     */
    protected $translatedAttributes = ['name'];

    /**
     * the attributes that mass assignable
     * @var string[]
     */
    protected $fillable = ['parent_id', 'slug', 'is_active','updated_at','created_at'];

    protected $hidden = ['translations'];

    /**
     * The attributes that should cast to native type
     * @var string[]
     */
    protected $casts = [
        'is_active'=> 'boolean'
    ];
}
