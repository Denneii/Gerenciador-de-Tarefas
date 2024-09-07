<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use Exception;

class TarefaController extends Controller
{
    /**
     * Listar todas as tarefas
     */
    public function index()
    { 
        $tarefas = Tarefa::all();
      
        return view('tarefas.tarefas', ['tarefas' => $tarefas]);
    }

    /**
     * Encontrar tarefa por ID para edição
     */
    public function find($id)
    {
        $tarefa = Tarefa::find($id); // Usar o método find no modelo
        
        if (!$tarefa) {
            return redirect()->route('tarefas.index')->with('error', 'Tarefa não encontrada.');
        }

        return view('tarefas.edit', ['tarefa' => $tarefa]);
    }

    /**
     * Atualizar tarefa
     */
    public function update(Request $request, $id)
    {
        $tarefa = Tarefa::find($id); // Usar o método find no modelo

        if (!$tarefa) {
            return redirect()->route('tarefas.index')->with('error', 'Tarefa não encontrada.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string|max:1000',
            'status' => 'required|in:pendente,concluída',
        ]);

        $tarefa->update($request->all());

        return redirect()->route('tarefas.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    /**
     * Criar nova tarefa
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string|max:1000',
            'status' => 'required|in:pendente,concluída',
        ]);

        Tarefa::create($request->all());

        return redirect()->route('tarefas.index')->with('success', 'Tarefa criada com sucesso!');
    }


    /**
     * Excluir tarefa
     */
    public function delete($id)
    {
        $tarefa = Tarefa::find($id);

        if (!$tarefa) {
            return redirect()->route('tarefas.index')->with('error', 'Tarefa não encontrada.');
        }

        $tarefa->delete();

        return redirect()->route('tarefas.index')->with('success', 'Tarefa excluída com sucesso!');
    }
}
