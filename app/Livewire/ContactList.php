<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

#[Layout('layouts.app')]
class ContactList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function with(): array
    {
        return [
            'contacts' => Contact::where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
                ->paginate($this->perPage)
        ];
    }

    public function delete(Contact $contact)
    {
        $contact->delete();
        session()->flash('success', 'Contato removido com sucesso!');
    }
}