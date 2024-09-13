<?php
namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Models\User;
use App\Models\Projeto;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function index($projeto_id)
    {
        $projeto = Projeto::findOrFail($projeto_id);
        $tarefas = Tarefa::where('projeto_id', $projeto_id)->get();
        return view('tarefas.index', compact('projeto', 'tarefas'));
    }
    
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
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'status' => 'required|integer',
            'projeto_id' => 'required|integer|exists:projetos,id',
            'admin_id' => 'required|integer|exists:users,id', 
        ]);

        $tarefa = new Tarefa();
        $tarefa->titulo = $validated['titulo'];
        $tarefa->descricao = $validated['descricao'];
        $tarefa->status = $validated['status'];
        $tarefa->projeto_id = $validated['projeto_id'];
        $tarefa->admin_id = $validated['admin_id'];
        $tarefa->save(); 
        
        $admins = User::role('admin')->get();
        $clientes = User::role('cliente')->get();
        $tarefas = Tarefa::all();

        // Encontra o projeto
        $projeto = Projeto::find($tarefa->projeto_id);

        if (isset($projeto)) {
            // Encontra o administrador e cliente associados ao projeto
            $admin = $admins->firstWhere('id', $projeto->admin_id);
            $cliente = $clientes->firstWhere('id', $projeto->cliente_id);

        }
        return view('projetos.show', compact('projeto', 'admin', 'cliente', 'tarefas'));

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

        // Atualizar campos exceto status se o status não for alterado
        $data = $request->except('status');

        
        $tarefa->status = 1; // Definindo status como 'Concluído'
        

        $tarefa->update($data);

        return redirect()->route('projetos.show', $projetoId);

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

    public function concluir(Tarefa $tarefa)
    {
        $tarefa->status = 1; // Status 1 para 'Concluído'
        $tarefa->save();

        //return redirect()->route('tarefas.index', ['projeto_id' => $tarefa->projeto_id])
                       // ->with('success', 'Tarefa concluída com sucesso!');
    }

    public function show(Tarefa $tarefa)
    {
        
    }

}
