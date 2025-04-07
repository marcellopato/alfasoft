<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function delete(Contact $contact)
    {
        // Verifica se o usuário está logado e é dono do contato
        if (!auth()->check() || $contact->user_id !== auth()->id()) {
            return;
        }

        $contact->delete();
        session()->flash('success', 'Contato excluído com sucesso!');
    }

    private function getContacts(): LengthAwarePaginator
    {
        return Contact::where(function($query) {
            $query->where('name', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%");
        })->paginate($this->perPage);
    }

    public function with(): array
    {
        return [
            'contacts' => $this->getContacts()
        ];
    }

    public function render()
    {
        return view('livewire.contact-list', $this->with())
            ->layout('layouts.app');
    }
}