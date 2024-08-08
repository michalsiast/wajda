<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rotator extends BaseModel
{
    protected $table = 'rotator';

    protected $fillable = [
        'title',
        'speed',
        'time',
        'pager',
        'arrows',
        'position',
        'active',
    ];


    public function save(array $options = [])
    {
        return parent::saveWithPositionAndLang($options);
    }

    public function gallery() {
        return $this->belongsTo(Gallery::class);
    }

    public function categories() {
        return $this->belongsTo(OfferCategory::class);
    }
}
