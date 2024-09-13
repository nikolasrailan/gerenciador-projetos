<?php
// app/Http/Controllers/ProjetoController.php
// app/Http/Controllers/ProjetoController.php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\Tarefa;
use App\Models\User;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Obtém o usuário autenticado

        // Se o usuário for um cliente, filtra os projetos que pertencem a ele
        if ($user->hasRole('cliente')) {
            $projetos = Projeto::with('admin', 'cliente')
                        ->where('cliente_id', $user->id) // Filtra os projetos vinculados ao cliente
                        ->get();
        } else {
            // Caso contrário, exibe todos os projetos
            $projetos = Projeto::with('admin', 'cliente')->get();
        }

        return view('dashboard', compact('projetos'));
    }



    public function create()
    {
        $admins = User::role('admin')->get(); // Obtém todos os admins
        $clientes = User::role('cliente')->get(); // Obtém todos os clientes
        return view('projetos.create', compact('admins', 'clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'admin_id' => 'required|exists:users,id',
            'cliente_id' => 'required|exists:users,id',
        ]);

        Projeto::create($request->all());

        return redirect()->route('dashboard', );
    }

    public function show(string $id)
    {
        // Obtém todos os admins e clientes
        $admins = User::role('admin')->get();
        $clientes = User::role('cliente')->get();
        $tarefas = Tarefa::all();

        // Encontra o projeto
        $projeto = Projeto::find($id);

        if (isset($projeto)) {
            // Encontra o administrador e cliente associados ao projeto
            $admin = $admins->firstWhere('id', $projeto->admin_id);
            $cliente = $clientes->firstWhere('id', $projeto->cliente_id);

        }
        return view('projetos.show', compact('projeto', 'admin', 'cliente', 'tarefas'));
    }


    public function edit(Projeto $projeto)
    {
        $admins = User::role('admin')->get(); // Obtém todos os admins
        $clientes = User::role('cliente')->get(); // Obtém todos os clientes
        return view('projetos.edit', compact('projeto', 'admins', 'clientes'));
    }

    public function update(Request $request, Projeto $projeto)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'admin_id' => 'required|exists:users,id',
            'cliente_id' => 'required|exists:users,id',
        ]);

        $projeto->update($request->all());

        return redirect()->route('dashboard');
    }

    public function destroy(string $id)
    {

        $projeto = Projeto::find($id);
        if(isset($projeto)){
            $projeto->delete();
            return redirect()->route('dashboard');
        }

        $projeto->delete();
        return redirect()->route('dashboard', compact('projetos'));
    }
}
