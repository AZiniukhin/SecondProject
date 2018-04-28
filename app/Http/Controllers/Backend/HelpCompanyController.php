<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelpCompanyController extends Controller
{
    //
    public function helpCompany()
    {
        return view('backend.helpCompany');
    }
}
