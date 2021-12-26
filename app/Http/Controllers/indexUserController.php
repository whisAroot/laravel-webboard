<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class indexUserController extends Controller
{
    public function index()
    {
        return view('webboard');
    }
}
