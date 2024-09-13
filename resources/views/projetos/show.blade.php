<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Projeto ' . $projeto->titulo) }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                <h2 class="text-3xl font-extrabold dark:text-black mb-2">Detalhes</h2>
                <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm">
                  <dl class="-my-3 divide-y divide-gray-100 text-sm">
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                      <dt class="font-medium text-gray-900">Título</dt>
                      <dd class="text-gray-700 sm:col-span-2">{{ $projeto->titulo }}</dd>
                    </div>
                
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                      <dt class="font-medium text-gray-900">Descrição</dt>
                      <dd class="text-gray-700 sm:col-span-2">{{ $projeto->descricao }}</dd>
                    </div>
                
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                      <dt class="font-medium text-gray-900">Data Início</dt>
                      <dd class="text-gray-700 sm:col-span-2">{{ $projeto->data_inicio }}</dd>
                    </div>
                
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                      <dt class="font-medium text-gray-900">Data Fim</dt>
                      <dd class="text-gray-700 sm:col-span-2">{{ $projeto->data_fim }}</dd>
                    </div>
                
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                      <dt class="font-medium text-gray-900">Administrador</dt>
                      <dd class="text-gray-700 sm:col-span-2">
                        {{ $admin->name }}
                      </dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                      <dt class="font-medium text-gray-900">Cliente</dt>
                      <dd class="text-gray-700 sm:col-span-2">
                        {{ $cliente->name }}
                      </dd>
                    </div>
                  </dl>
                </div>
              </div>
          </div>
      </div>
  </div>

  @include('tarefas.index', ['projeto' => $projeto])
</x-app-layout>
