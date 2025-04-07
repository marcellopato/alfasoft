<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-red-600">
            {{ __('Deletar Conta') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Uma vez que sua conta é deletada, todos os recursos e dados serão permanentemente excluídos.') }}
        </p>
    </header>

    <form wire:submit="deleteUser" class="mt-6">
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
            <input type="password"
                   wire:model="password"
                   id="password"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                   placeholder="Sua senha atual">
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700"
                    onclick="return confirm('Tem certeza que deseja deletar sua conta?')">
                Deletar Conta
            </button>
        </div>
    </form>
</section>
