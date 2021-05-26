<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function isValidInteger($value): bool
    {
        if (empty($value) || !is_numeric($value) || intval($value) < 0 || intval($value) != $value) {
            return false;
        } else {
            return true;
        }
    }
}
