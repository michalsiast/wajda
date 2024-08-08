<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';

    public function items() {
        return $this->hasMany(GalleryItem::class)
            ->orderBy('position');
    }

    public function activeItems() {
        return $this->hasMany(GalleryItem::class)
            ->where('active', '=', 1)
            ->orderBy('position');
    }

    public function itemsWithoutCover() {
        return $this->hasMany(GalleryItem::class)
            ->where('type', '!=', 'cover')
            ->orderBy('position');
    }

    public function activeItemsWithoutCover() {
        return $this->hasMany(GalleryItem::class)
            ->where('type', '!=', 'cover')
            ->where('active', '=', 1)
            ->orderBy('position');
    }

    public function cover() {
        return $this->hasOne(GalleryItem::class)
            ->where('type', '=', 'cover');
    }

    public function coverUrl() {
        $cover = $this->hasOne(GalleryItem::class)
            ->where('type', '=', 'cover')
            ->first();
        if($cover) {
            return $cover->url;
        }
        return '';
    }


    public function delete()
    {
        $this->items()->delete();
        return parent::delete();
    }
}
