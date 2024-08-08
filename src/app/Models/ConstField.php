<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Base model.
 *
 * @property int $id
 * @property string $name
 * @property string $lang
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class ConstField extends Model
{
    protected $table = 'const_field';

    protected $fillable = ['name', 'value'];

    public function scopeLocale($query, string $locale = null) {
        if(empty($locale)) {
            $locale = getAdminLang();
        }
        return $query->where('lang', '=', $locale);
    }

    public function scopeAdminLocale($query, string $locale = null) {
        if(empty($locale)) {
            $locale = getAdminLang();
        }
        return $query->where('lang', '=', $locale);
    }

    public function save(array $options = [])
    {
        if(!isset($this->lang)) {
            $this->lang = app()->getLocale();
        }
        return parent::save($options);
    }
}
