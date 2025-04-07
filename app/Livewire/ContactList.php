<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.contact-list', [
            'contacts' => Contact::paginate(10)
        ])->layout('layouts.app');
    }
}