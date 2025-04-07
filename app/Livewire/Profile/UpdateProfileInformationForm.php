<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateProfileInformationForm extends Component
{
    public $name;
    public $email;

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updateProfileInformation()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
        ]);

        $user = Auth::user();
        $emailChanged = $user->email !== $validated['email'];

        if ($emailChanged) {
            $user->email_verified_at = null;
        }

        $user->fill($validated);
        $user->save();

        $this->dispatch('profile-updated', ['message' => 'Perfil atualizado com sucesso!']);
    }

    public function render()
    {
        return view('livewire.profile.update-profile-information-form');
    }
}