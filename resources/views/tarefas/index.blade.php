<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-5">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex justify-between p-6 text-gray-900">
            <h2 class="text-3xl font-extrabold dark:text-black mb-2">Tarefas</h2>

            @role('admin')
                <a href="{{ route('tarefas.create', $projeto_id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Nova Tarefa') }}
                </a>
            @endrole
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 p-4">
            @foreach ($tarefas as $tarefa)
                @if ($tarefa->projeto_id == $projeto_id)
                    <div class="relative flex flex-col bg-white shadow-sm border border-slate-200 rounded-lg">
                        <div class="p-4">
                            <div class="flex justify-between">
                                <h5 class="mb-2 text-slate-800 text-xl font-semibold">
                                    {{$tarefa->titulo}}
                                </h5>
                                @if($tarefa->admin_id == Auth::id()) <!-- Verifica se o admin_id da tarefa é o ID do usuário logado -->
                                    <a class="font-medium text-red-600 hover:underline cursor-pointer"
                                        onclick="openDeleteConfirmModal({{ $tarefa->id }})">
                                        X
                                    </a>    
                                @endif
                            </div>
                            <p class="text-slate-600 leading-normal font-light">
                                {{$tarefa->descricao}}
                            </p>
                            <div class="flex justify-between items-end mt-4">
                                <span>Status: {{$tarefa->status == 0 ? 'Em andamento' : 'Concluída'}}</span>

                                @role('admin')
                                @if ($tarefa->status == 0 && $tarefa->admin_id == Auth::id())
                                    <button type="button" class="ml-2 rounded-md bg-slate-800 py-2 px-4 text-white shadow-md hover:bg-slate-700"
                                        onclick="openConfirmModal({{ $tarefa->id }})">
                                        Concluir
                                    </button>

                                    <!-- Modal de Confirmação de Conclusão -->
                                    <div id="confirmModal-{{ $tarefa->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center">
                                        <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
                                        <div class="bg-white rounded-lg overflow-hidden shadow-xl max-w-sm p-6 z-50">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Confirmar Conclusão</h3>
                                            <p class="mb-4">Tem certeza que deseja marcar a tarefa "{{ $tarefa->titulo }}" como concluída?</p>
                                            <div class="flex justify-end">
                                                <button type="button" class="mr-4 text-gray-500 hover:text-gray-700" onclick="closeConfirmModal({{ $tarefa->id }})">Cancelar</button>
                                                <form action="{{ route('tarefas.update', $tarefa->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="1">
                                                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Concluir</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal de Confirmação de Exclusão -->
                                    <div id="deleteConfirmModal-{{ $tarefa->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center">
                                        <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
                                        <div class="bg-white rounded-lg overflow-hidden shadow-xl max-w-sm p-6 z-50">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Confirmar Exclusão</h3>
                                            <p class="mb-4">Tem certeza que deseja excluir a tarefa "{{ $tarefa->titulo }}"?</p>
                                            <div class="flex justify-end">
                                                <button type="button" class="mr-4 text-gray-500 hover:text-gray-700" onclick="closeDeleteConfirmModal({{ $tarefa->id }})">Cancelar</button>
                                                <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Excluir</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @endrole
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

<script>
    function openConfirmModal(tarefaId) {
        document.getElementById('confirmModal-' + tarefaId).classList.remove('hidden');
    }

    function closeConfirmModal(tarefaId) {
        document.getElementById('confirmModal-' + tarefaId).classList.add('hidden');
    }

    function openDeleteConfirmModal(tarefaId) {
        document.getElementById('deleteConfirmModal-' + tarefaId).classList.remove('hidden');
    }

    function closeDeleteConfirmModal(tarefaId) {
        document.getElementById('deleteConfirmModal-' + tarefaId).classList.add('hidden');
    }
</script>
