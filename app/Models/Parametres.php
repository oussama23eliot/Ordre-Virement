<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametres extends Model
{
    use HasFactory;
    protected $fillable = [
        'key',
        'value'
    ];


    static public $settings = null;

    static function get($key, $default = null)
    {
        if (empty(self::$settings)) {
            self::$settings = self::all();
        }
        $model = self
            ::$settings
            ->where('key', $key)
            ->first();
        if (empty($model)) {
            if (empty($default)) {
                return $default;
            } else {
                return $default;
            }
        } else {
            return $model->value;
        }
    }

    static function set(string $key, $value)
    {
        if (empty(self::$settings)) {
            self::$settings = self::all();
        }
        $model = self
            ::$settings
            ->where('key', $key)
            ->first();

        if (empty($model)) {
            $model = self::create([
                'key' => $key,
                'value' =>  null
            ]);
            self::$settings->push($model);
        } else {
            $model->update(compact('value'));
        }
        return true;
    }
}
