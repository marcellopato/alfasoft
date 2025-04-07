<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = auth()->user()->contacts()->get();
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(ContactRequest $request)
    {
        $request->user()->contacts()->create($request->validated());
        return redirect()->route('contacts.index')->with('success', 'Contato criado com sucesso!');
    }

    public function show(Contact $contact)
    {
        abort_if($contact->user_id !== auth()->id(), 403);
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        abort_if($contact->user_id !== auth()->id(), 403);
        return view('contacts.edit', compact('contact'));
    }

    public function update(ContactRequest $request, Contact $contact)
    {
        abort_if($contact->user_id !== auth()->id(), 403);
        $contact->update($request->validated());
        return redirect()->route('contacts.index')->with('success', 'Contato atualizado com sucesso!');
    }

    public function destroy(Contact $contact)
    {
        abort_if($contact->user_id !== auth()->id(), 403);
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contato removido com sucesso!');
    }
}
