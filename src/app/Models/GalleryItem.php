<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $table = 'gallery_item';

    protected $fillable = ['url', 'name', 'type', 'text', 'active'];

    public function gallery() {
        return $this->belongsTo(Gallery::class);
    }
}
