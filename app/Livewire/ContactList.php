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

    public function with(): array
    {
        return [
            'contacts' => $this->getContacts()
        ];
    }

    private function getContacts(): LengthAwarePaginator
    {
        if (!auth()->check()) {
            // Retorna uma coleção vazia paginada
            return new \Illuminate\Pagination\LengthAwarePaginator(
                [], 0, $this->perPage
            );
        }

        return auth()->user()->contacts()
            ->where(function($query) {
                $query->where('name', 'like', "%{$this->search}%")
                      ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.contact-list', $this->with())
            ->layout('layouts.app');
    }
}