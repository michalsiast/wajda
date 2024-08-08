<?php

namespace App\Models;

use Illuminate\Database\Concerns\BuildsQueries;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Page extends BaseModel
{
    use HasFactory;

    protected $table = 'page';

    protected $fillable = ['name', 'type', 'active'];


    public function save(array $options = [])
    {
        return parent::saveWithPositionAndLang($options);
    }


    public function fields() {
        return $this->hasMany(Field::class);
    }

    public function gallery() {
        return $this->belongsTo(Gallery::class);
    }
}
