<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class PhoneNumberController extends Controller
{

    /**
     * Render index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }
}
