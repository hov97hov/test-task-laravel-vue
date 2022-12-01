<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GroupsController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Groups');
    }

    /**
     * @return Response
     */
    public function groupPage(): Response
    {
        return Inertia::render('Group');
    }
}
