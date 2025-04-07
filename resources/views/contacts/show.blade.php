@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Detalhes do Contato</h1>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Nome:</dt>
                <dd class="col-sm-9">{{ $contact->name }}</dd>

                <dt class="col-sm-3">Contato:</dt>
                <dd class="col-sm-9">{{ $contact->contact }}</dd>

                <dt class="col-sm-3">Email:</dt>
                <dd class="col-sm-9">{{ $contact->email }}</dd>
            </dl>
        </div>
        <div class="card-footer">
            <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza?')">
                    Excluir
                </button>
            </form>
            <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
@endsection