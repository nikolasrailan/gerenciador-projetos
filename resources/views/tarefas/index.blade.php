<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-5">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex justify-between p-6 text-gray-900">
            <h2 class="text-3xl font-extrabold dark:text-black mb-2">Tarefas</h2>
            
            @role('admin') 
                <a href="{{ route('tarefas.create', $projeto_id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
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
                                @role('admin')
                                    <button type="button" class="font-medium text-red-600 hover:underline" onclick="openModal('modal-{{ $tarefa->id }}')">
                                        X
                                    </button>
                                @endrole

                                <x-delete-modal 
                                    :modalId="'modal-' . $tarefa->id" 
                                    message="Tem certeza que deseja excluir a tarefa '{{ $tarefa->titulo }}'?"
                                    :action="route('tarefas.destroy', $tarefa->id)"
                                />
                            </div>
                            <p class="text-slate-600 leading-normal font-light">
                                {{$tarefa->descricao}}
                            </p>
                            <div class="flex justify-between items-end mt-4">
                                <span>Status: {{$tarefa->status == 0 ? 'Em andamento' : 'Concluída'}}</span>
                                @role('admin')
                                @if ($tarefa->status == 0)
                                <form action="{{ route('tarefas.update', $tarefa->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="ml-2 rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                        Concluir  
                                    </button>
                                </form>
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
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
