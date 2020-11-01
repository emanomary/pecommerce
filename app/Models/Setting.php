<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
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

    protected $table = "settings";

    /**
     * the attributes that will translated
     * @var string[]
     */
    protected $translatedAttributes = ['value'];

    /**
     * the attributes that mass assignable
     * @var string[]
     */
    protected $fillable = ['key', 'is_translatable', 'plain_value'];

    protected $hidden = ['translations'];

    public $timestamps = true;

    /**
     * The attributes that should cast to native type
     * @var string[]
     */
    protected $casts = [
        'is_translatable' => 'boolean',
        'value'=> 'string'
    ];

    /**
     * set the given settings in database
     * @param $settings
     */
    public static function setMAny($settings)
    {
        foreach ($settings as $key => $value) {
            self::set($key, $value);
        }
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function set($key, $value)
    {
        if ($key === 'translatable') {
            return static::setTranslatableSettings($value);
        }

        if(is_array($value))
        {
            $value = json_encode($value);
        }

        static::updateOrCreate(['key' => $key], ['plain_value' => $value]);
    }

    /**
     * to save translatable settings in setting_translations
     *
     * @param array $settings
     */
    public static function setTranslatableSettings($settings = [])
    {
        foreach ($settings as $key => $value) {
            static::updateOrCreate(['key' => $key], [
                'is_translatable' => true,
                'value' => $value
            ]);
        }
    }
}
