<?php


namespace App\Http\Controllers;


use App\Models\Rotator;

class RotatorController extends Controller
{

    public function base($view){
        $rotator = Rotator::with(['gallery'])
            ->where('id', $view->id_rotator)
            ->activeAndLocale()
            ->first();

        $view->rotator = $rotator;
    }

}
