<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista de Contatos</h1>
        @auth
            <a href="{{ route('contacts.create') }}" class="btn btn-primary">Novo Contato</a>
        @endauth
    </div>

    <div class="mb-3">
        <input wire:model.live="search" 
               type="text" 
               class="form-control" 
               placeholder="Buscar contatos...">
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Contato</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->contact }}</td>
                        <td>{{ $contact->email }}</td>
                        <td class="d-flex gap-2">
                            @auth
                                <a href="{{ route('contacts.show', $contact) }}" 
                                   class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('contacts.edit', $contact) }}" 
                                   class="btn btn-warning btn-sm">Editar</a>
                                <button wire:click="delete({{ $contact->id }})" 
                                        class="btn btn-danger btn-sm"
                                        x-on:click="confirm('Tem certeza?') || $event.preventDefault()">
                                    Excluir
                                </button>
                            @endauth
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Nenhum contato encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $contacts->links() }}
    </div>
</div>