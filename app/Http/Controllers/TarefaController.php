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
    public function create($projeto_id)
    {
        $projeto = Projeto::findOrFail($projeto_id);
        return view('tarefas.create', ['projeto' => $projeto]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação básica dos dados recebidos
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'status' => 'required|integer',
            'projeto_id' => 'required|integer|exists:projetos,id', // Certificar-se que o projeto existe
            'admin_id' => 'required|integer|exists:users,id', // Certificar-se que o admin existe
        ]);

        // Criar nova tarefa
        $tarefa = new Tarefa();
        $tarefa->titulo = $validated['titulo'];
        $tarefa->descricao = $validated['descricao'];
        $tarefa->status = $validated['status'];
        $tarefa->projeto_id = $validated['projeto_id'];
        $tarefa->admin_id = $validated['admin_id'];
        $tarefa->save(); // Salvar a tarefa no banco de dados

        // Redirecionar após o salvamento
        return redirect()->route('tarefas.index')->with('success', 'Tarefa cadastrada com sucesso!');
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
