<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferCategory extends BaseModel
{
    protected $table = 'offer_category';

    protected $fillable = ['title', 'lead', 'text', 'position', 'active'];

    public function gallery() {
        return $this->belongsTo(Gallery::class);
    }

    public function save(array $options = [])
    {
        return parent::saveWithPositionAndLang($options);
    }
}
