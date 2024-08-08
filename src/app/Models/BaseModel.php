<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;


class BaseModel extends Model
{
    protected $attributes = [
        'active' => 0,
    ];


    public function scopeActive($query, int $active = 1) {
        return $query->where('active', '=', $active);
    }

    public function scopeLocale($query, string $locale = null) {
        if(empty($locale)) {
            $locale = app()->getLocale();
        }
        return $query->where('lang', '=', $locale);
    }

    public function scopeAdminLocale($query, string $locale = null) {
        if(empty($locale)) {
            $locale = getAdminLang();
        }
        return $query->where('lang', '=', $locale);
    }

    public function scopeActiveAndLocale($query) {
        return $this->scopeActive($query)->locale();
    }

    public function scopeAdminActiveAndLocale($query) {
        return $this->scopeActive($query)->adminLocale();
    }


    public function saveWithLang(array $options = []) {
        if(!isset($this->lang)) {
            $this->lang = getAdminLang();
        }
        return parent::save($options);
    }


    public function saveWithPosition(array $options = []) {
        parent::save($options);
        if(!isset($this->position)) {
            $this->position = $this->getKey();
        }
        return parent::save($options);
    }


    public function saveWithPositionAndLang(array $options = []) {
        if(!isset($this->lang)) {
            $this->lang = getAdminLang();
        }
        parent::save($options);
        if(!isset($this->position)) {
            $this->position = $this->getKey();
        }
        return parent::save($options);
    }


    public function getTable()
    {
        return $this->table;
    }

    public static function getTableName() {
        return with(new static)->getTable();
    }


    public function seo() {
        return $this->belongsTo(Seo::class);
    }

    public function galleryCover() {
        $gallery = $this->belongsTo(Gallery::class, 'gallery_id', 'id')->first();
        $url = '';

        if($gallery) {
            $cover = $gallery->items
                ->where('active', '=', 1)
                ->where('type', '=', 'cover')
                ->first();
            if($cover) {
                $url = $cover->url;
            }
        }

        return $url;
    }
}
