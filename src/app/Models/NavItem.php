<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavItem extends BaseModel
{
    use HasFactory;

    protected $table = 'nav_item';

    protected $fillable = [
        'nav_item_id',
        'page_id',
        'nav_name',
        'label',
        'url',
        'target',
        'active',
    ];

    public function page() {
        return $this->belongsTo(Page::class);
    }

    public function navItem() {
        return $this->belongsTo(NavItem::class);
    }

    public function navItems() {
        return $this->hasMany(NavItem::class);
    }

    public function save(array $options = [])
    {
        return parent::saveWithPositionAndLang($options);
    }
}
