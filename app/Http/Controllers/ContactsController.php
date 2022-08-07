<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactsController extends Controller
{
    /**
     * .
     */
    public function index()
    {
        $contacts = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode('developer:developer'),
        ])->acceptJson()->get('https://egdev.crmforschools.net/api/contacts');

        $contacts = $contacts['contacts'];
        
        return view('contacts.index', ['contacts' => $contacts]);
    }

    /**
     * .
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * .
     */
    public function store(StoreContactRequest $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode('developer:developer'),
        ])->post('https://egdev.crmforschools.net/api/contacts/new', [
            'campus' => 'developer',
            'contact_type' => 'Lead',
            'owner' => '40',
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'birth_date' => $request->birth_date
        ]);
        
        if($response->status() == 201) {
            return redirect()->back()->with('success', 'The contact was created succesfully!');
        }
    }

    /**
     * .
     */
    public function show($contactId)
    {
        $contact = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode('developer:developer'),
        ])->acceptJson()->get('https://egdev.crmforschools.net/api/contacts/' . $contactId);

        return view('contacts.update', ['contact' => $contact['contact']]);
    }

    /**
     * .
     */
    public function update(UpdateContactRequest $request, $id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode('developer:developer'),
        ])->patch('https://egdev.crmforschools.net/api/contacts/' . $id . '/edit', [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'birth_date' => $request->birth_date
        ]);

        if($response->status() == 200) {
            return redirect()->back()->with('success', 'The contact was updated succesfully!');
        }
    }

    /**
     * .
     */
    public function destroy($id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode('developer:developer'),
        ])->delete('https://egdev.crmforschools.net/api/contacts/' . $id . '/delete');

        if($response->status() == 200) {
            return redirect()->back()->with('success', 'The contact was deleted succesfully!');
        }
    }
}
