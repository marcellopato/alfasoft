@extends('layouts.app')

@section('content')
    <h1>Novo Contato</h1>

    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf
        @include('contacts._form')
        
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection