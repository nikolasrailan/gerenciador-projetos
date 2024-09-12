<!-- resources/views/projetos/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Projeto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('projetos.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="titulo" class="block text-sm font-medium text-gray-700">Titulo</label>
                            <input type="text" name="titulo" id="titulo" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                            <textarea name="descricao" id="descricao" class="mt-1 block w-full"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="data_inicio" class="block text-sm font-medium text-gray-700">Data inicio</label>
                            <input type="date" name="data_inicio" id="data_inicio" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="data_fim" class="block text-sm font-medium text-gray-700">Data Fim</label>
                            <input type="date" name="data_fim" id="data_fim" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="admin_id" class="block text-sm font-medium text-gray-700">Admin</label>
                            <select name="admin_id" id="admin_id" class="mt-1 block w-full" required>
                                @foreach($admins as $admin)
                                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="cliente_id" class="block text-sm font-medium text-gray-700">Client</label>
                            <select name="cliente_id" id="cliente_id" class="mt-1 block w-full" required>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex justify-end">

                            <x-primary-button class="mt-4">{{ __('Cadastrar') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
