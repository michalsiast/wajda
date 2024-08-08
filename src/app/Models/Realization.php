<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realization extends BaseModel
{
    protected $table = 'realization';

    protected $fillable = ['realization_category_id', 'title', 'lead', 'text', 'position', 'active'];

    public function gallery() {
        return $this->belongsTo(Gallery::class);
    }

    public function categories() {
        return $this->belongsTo(RealizationCategory::class);
    }

    public function save(array $options = [])
    {
        return parent::saveWithPositionAndLang($options);
    }
}
