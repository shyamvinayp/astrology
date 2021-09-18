<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	protected function requestToFillable(Request $request, $model, $ignore = []) {
        $instance = gettype($model) === 'object'?$model:new $model();
        foreach ($instance->getFillable() as $col) {
            if(in_array($col, $ignore)) continue;
            if(in_array($col, array_keys($instance->getCasts(),'boolean'))) {//target col is casted as boolean
                $instance->$col = (bool) $request->input($col);
                $request->request->remove($col);
            }
            if(array_key_exists($col, $request->all())) {
                $instance->$col = ($this->purifyInput && $request->input($col))?Purifier::clean($request->input($col)):$request->input($col);
            }
        }
        return $instance;
    }
}
