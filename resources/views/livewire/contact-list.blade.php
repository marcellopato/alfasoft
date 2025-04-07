<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Contatos</h2>
            @auth
                <a href="{{ route('contacts.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Novo Contato
                </a>
            @endauth
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contato</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($contacts as $contact)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $contact->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $contact->contact }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $contact->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('contacts.show', $contact) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 mr-3">Ver</a>
                                @auth
                                    @if($contact->user_id === auth()->id())
                                        <a href="{{ route('contacts.edit', $contact) }}" 
                                           class="text-yellow-600 hover:text-yellow-900 mr-3">Editar</a>
                                        <button wire:click="delete({{ $contact->id }})"
                                                wire:confirm="Tem certeza que deseja excluir este contato?"
                                                class="text-red-600 hover:text-red-900">
                                            Excluir
                                        </button>
                                    @endif
                                @endauth
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                Nenhum contato encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>