<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminMapController extends Controller
{
    //
    public function index()
    {
        return  view('default.adminMapCourier');
    }
}
