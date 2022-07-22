<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Home');
    }


    public function index2(): Response
    {
        return Inertia::render('Blog', [
            'event' => 'anausun',
        ]);
    }
}
