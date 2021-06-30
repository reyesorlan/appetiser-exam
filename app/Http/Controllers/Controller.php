<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    static function checkInput(array $input, array $requiredFields)
    {
        $valid = true;
        $missingFields = [];
        
        foreach( $requiredFields as $key )
        {
            $hasKey = false;
            forEach($input as $k => $v)
            {
                if ($k === $key)
                {
                    $hasKey = true;
                }
            }
            if (!$hasKey)
            {
                array_push($missingFields, $key);
            }
        }
        
        return $missingFields;
    }
}
