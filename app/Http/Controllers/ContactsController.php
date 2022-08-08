<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactsController extends Controller
{
    /**
     * Get contacts list.
     */
    public function index()
    {
        $contacts = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(env('MAUTIC_USERNAME').':'.env('MAUTIC_PASSWORD')),
        ])->acceptJson()->get(env('MAUTIC_API_URL').'api/contacts');

        $contacts = $contacts['contacts'];
        
        return view('contacts.index', ['contacts' => $contacts]);
    }

    /**
     * Get the form to create new contact.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Add new contact.
     */
    public function store(StoreContactRequest $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(env('MAUTIC_USERNAME').':'.env('MAUTIC_PASSWORD')),
        ])->post(env('MAUTIC_API_URL').'api/contacts/new', [
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
     * Get the form to edit existed contact.
     */
    public function show($contactId)
    {
        $contact = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(env('MAUTIC_USERNAME').':'.env('MAUTIC_PASSWORD')),
        ])->acceptJson()->get(env('MAUTIC_API_URL').'api/contacts/' . $contactId);

        return view('contacts.update', ['contact' => $contact['contact']]);
    }

    /**
     * Update contact.
     */
    public function update(UpdateContactRequest $request, $id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(env('MAUTIC_USERNAME').':'.env('MAUTIC_PASSWORD')),
        ])->patch(env('MAUTIC_API_URL').'api/contacts/' . $id . '/edit', [
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
     * Delete contact.
     */
    public function destroy($id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(env('MAUTIC_USERNAME').':'.env('MAUTIC_PASSWORD')),
        ])->delete(env('MAUTIC_API_URL').'api/contacts/' . $id . '/delete');

        if($response->status() == 200) {
            return redirect()->back()->with('success', 'The contact was deleted succesfully!');
        }
    }
}
