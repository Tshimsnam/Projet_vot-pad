<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BreadcrumbException extends Exception
{
    public function render($request)
    {
        return Redirect::route('dashboard');
    }
}