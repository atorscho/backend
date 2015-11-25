<?php

namespace Atorscho\Backend\Http\Controllers;

use Illuminate\Http\Request;

use Doskaa\Http\Requests;
use Doskaa\Http\Controllers\Controller;

class InstallerController extends Controller
{
    public function step1()
    {
        return view('backend::step1');
    }
}
