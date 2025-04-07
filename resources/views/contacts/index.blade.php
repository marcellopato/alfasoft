@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista de Contatos</h1>
        <a href="{{ route('contacts.create') }}" class="btn btn-primary">Novo Contato</a>
    </div>

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
                        <a href="{{ route('contacts.show', $contact) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Nenhum contato cadastrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection