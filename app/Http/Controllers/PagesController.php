<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function About() {
        return view('pages.about');
    }

    public function getGaming() {
        return view('pages.gaming');
    }

    public function getMobile() {
        return view('pages.mobile');
    }
}
