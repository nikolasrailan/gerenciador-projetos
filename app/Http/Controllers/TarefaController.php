<?php
namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Models\Projeto;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projetos = Projeto::all(); // Todos os projetos disponíveis
        return view('tarefas.create', compact('projetos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'status' => 'required|boolean',
            'projeto_id' => 'required|exists:projetos,id',
            'admin_id' => 'required|exists:users,id',
        ]);

        Tarefa::create($request->all());

        return redirect()->route('projetos.show', $request->projeto_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarefa $tarefa)
    {
        return view('tarefas.show', compact('tarefa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarefa $tarefa)
    {
        $projetos = Projeto::all(); // Todos os projetos disponíveis
        return view('tarefas.edit', compact('tarefa', 'projetos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'status' => 'required|boolean',
            'projeto_id' => 'required|exists:projetos,id',
            'admin_id' => 'required|exists:users,id',
        ]);

        $tarefa->update($request->all());

        return redirect()->route('projetos.show', $tarefa->projeto_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {
        $projetoId = $tarefa->projeto_id;
        $tarefa->delete();
        return redirect()->route('projetos.show', $projetoId);
    }
}
