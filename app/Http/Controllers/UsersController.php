<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Users');
    }

    /**
     * @return Response
     */
    public function userPage(): Response
    {
        return Inertia::render('User');
    }
}
