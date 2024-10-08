<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between p-6 text-gray-800 leading-tight">
                    <h2 class="text-4xl font-extrabold dark:text-black">Projetos</h2>

                    @role('admin') <!-- Verifica se o usuário tem o papel de admin -->
                        <a href="{{ route('projetos.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Cadastrar') }}
                        </a>
                    @endrole
                </div>

                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Título</th>
                                    <th scope="col" class="px-6 py-3">Descrição</th>
                                    
                                    <th scope="col" class="px-6 py-3">Cliente</th>
                                    <th scope="col" class="px-6 py-3 text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projetos as $projeto)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $projeto->titulo }}
                                        </th>
                                        <td class="px-6 py-4">{{ $projeto->descricao }}</td>
                                        
                                        <td class="px-6 py-4">{{ $projeto->cliente->name }}</td>
                                        <td class="px-6 py-4 text-right flex items-center justify-around">
                                            <a href="{{ route('projetos.show', $projeto->id) }}" class="font-medium text-blue-600 hover:underline">Visualizar</a>
                                            @role('admin')
                                                <a href="{{ route('projetos.edit', $projeto) }}" class="font-medium text-blue-600 hover:underline">Editar</a>
                                                <button type="button" class="font-medium text-red-600 hover:underline" onclick="openModal('modal-{{ $projeto->id }}')">
                                                    Deletar
                                                </button>
                                            @endrole
                                        </td>

                                        <!-- Componente de modal -->
                                        <x-delete-modal 
                                            :modalId="'modal-' . $projeto->id" 
                                            message="Tem certeza que deseja excluir o projeto '{{ $projeto->titulo }}'?"
                                            :action="route('projetos.destroy', $projeto->id)"
                                        />

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
