<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestPasswordController extends Controller
{
    public function showPasswordForm()
    {
        return view('passwordRequest');
    }
}
