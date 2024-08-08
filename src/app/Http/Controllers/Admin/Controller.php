<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;

class Controller {
    protected $request;

    public function SetStatus() {
        $data = request()->all();

        $id = $data['source_id'];
        $value = $data['value'];
        $model = $data['model'];
        DB::table($model)->where('id', '=', $id)->update(['active' => $value]);
        echo "set OK";
    }
}
