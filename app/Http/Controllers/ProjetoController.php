<?php
// app/Http/Controllers/ProjetoController.php
// app/Http/Controllers/ProjetoController.php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\User;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    public function index()
    {
        $projetos = Projeto::with('admin', 'cliente')->get();
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

    public function show(Projeto $projeto)
    {
        return view('projetos.show', compact('projeto'));
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
