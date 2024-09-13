<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Criar Tarefa') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                  <form method="POST" action="{{ route('tarefas.store') }}">
                      @csrf
                      <div class="mb-4">
                          <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                          <input type="text" name="titulo" id="titulo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                      </div>

                      <div class="mb-4">
                          <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                          <textarea name="descricao" id="descricao" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                      </div>

                      <div class="mb-4">
                          <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                          <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                              <option value="0">Em andamento</option>
                              <option value="1">Concluído</option>
                          </select>
                      </div>

                      <div class="mb-4">
                          <label for="projeto_id" class="block text-sm font-medium text-gray-700">Projeto</label>
                          <select name="projeto_id" id="projeto_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
                            <option  selected value="{{ $projeto->id }}">{{ $projeto->titulo }}</option>
                        </select>
                        
                      </div>

                      <div class="mb-4">
                          <label for="admin_id" class="block text-sm font-medium text-gray-700">Responsável</label>
                          <select name="admin_id" id="admin_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                              @foreach (App\Models\User::role('admin')->get() as $admin)
                                  <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                              @endforeach
                          </select>
                      </div>

                      <div>
                          <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Salvar</button>
                      </div>

                  </form>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
