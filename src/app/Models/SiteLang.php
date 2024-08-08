<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteLang extends BaseModel
{
    protected $table = 'site_lang';

    protected $fillable = ['name', 'full_name', 'default_site', 'default_admin', 'active'];

    public function scopeDefaultSite($query) {
        return $query->where('default_site', '=', 1);
    }

    public function scopeDefaultAdmin($query) {
        return $query->where('default_admin', '=', 1)->first();
    }

    public function save(array $options = [])
    {
        return parent::saveWithPosition($options);
    }
}
