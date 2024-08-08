<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends BaseModel
{
    protected $table = 'offer';

    protected $fillable = [
        'offer_category_id',
        'title',
        'lead',
        'text',
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
