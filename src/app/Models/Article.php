<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends BaseModel
{
    protected $table = 'article';

    protected $fillable = ['article_category_id', 'title', 'lead', 'text', 'active'];

    public function gallery() {
        return $this->belongsTo(Gallery::class);
    }

    public function categories() {
        return $this->belongsTo(ArticleCategory::class);
    }

    public function save(array $options = [])
    {
        return parent::saveWithPositionAndLang($options);
    }
}
