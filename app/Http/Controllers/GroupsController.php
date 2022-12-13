<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddContactGroupRequest;
use App\Http\Requests\CreateGroupRequest;
use App\Interfaces\Group\GroupInterface;
use App\Models\Contact;
use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GroupsController extends Controller
{
    protected $group;

    public function __construct(GroupInterface $group)
    {
        $this->group = $group;
    }

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

    /**
     * @param CreateGroupRequest $request
     */
    public function createGroup(CreateGroupRequest $request)
    {
        $this->group->createGroup($request->all());
    }

    /**
     * @return JsonResponse
     */
    public function getGroups(): JsonResponse
    {
        return \response()->json([
           'groups' => Group::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * @param Request $request
     */
    public function deleteGroup(Request $request)
    {
        return Group::where('id', $request->id)->delete();
    }

    public function addContactGroup(AddContactGroupRequest $request)
    {

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getGroupUsers(Request $request): JsonResponse
    {
        return response()->json([
            'groupContacts' => Contact::where()
        ]);
    }
}
