<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Gallery;
use Illuminate\Database\Eloquent\Model;

class RealizationCategory extends BaseModel
{
    protected $table = 'realization_category';

    protected $fillable = ['title', 'lead', 'text', 'position', 'active'];

    public function gallery() {
        return $this->belongsTo(Gallery::class);
    }

    public function save(array $options = [])
    {
        return parent::saveWithPositionAndLang($options);
    }
}
