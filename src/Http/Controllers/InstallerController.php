<?php

namespace Atorscho\Backend\Http\Controllers;

use Doskaa\Http\Requests;
use Doskaa\Http\Controllers\Controller;

class InstallerController extends Controller
{
    public function step1()
    {
        return view('backend::step1');
    }
}
