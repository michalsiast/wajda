<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $table = 'seo';

    protected $fillable = ['url', 'title', 'description', 'tags'];

    public function save(array $options = [])
    {
        if(!isset($this->lang)) {
            $this->lang = getAdminLang();
        }

        return parent::save($options);
    }
}
