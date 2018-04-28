<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IFrameController extends Controller
{
    //
    public function iFrame()
    {
        return view('backend.iFrame');
    }
}
