<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends BaseModel
{
    protected $table = 'field';

    protected $fillable = ['page_id', 'type', 'label', 'name', 'value'];

    public function save(array $options = [])
    {
        return parent::saveWithPosition($options);
    }
}
