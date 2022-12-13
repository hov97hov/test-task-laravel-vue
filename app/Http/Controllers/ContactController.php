<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Interfaces\Contact\ContactInterface;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    protected $contact;

    public function __construct(ContactInterface $contact)
    {
        $this->contact = $contact;
    }

    public function index(): Response
    {
        return Inertia::render('Contacts');
    }

    /**
     * @return Response
     */
    public function createContactPage(): Response
    {
        return Inertia::render('AddContact');
    }

    /**
     * @param CreateContactRequest $request
     */
    public function createContact(CreateContactRequest $request)
    {
        return $this->contact->createContact($request);
    }

    /**
     * @return JsonResponse
     */
    public function getContacts(): JsonResponse
    {
        return \response()->json([
            'contacts' => Contact::all()
        ]);
    }

    /**
     * @param UpdateContactRequest $request
     */
    public function updateContact(UpdateContactRequest $request)
    {
        $this->contact->updateContact($request->all());
    }

    /**
     * @param Request $request
     */
    public function deleteContact(Request $request)
    {
        $this->contact->deleteContact($request->id);
    }

    /**
     * @param Request $request
     */
    public function deleteContacts(Request $request)
    {
        $this->contact->deleteContacts($request->ids);
    }
}
