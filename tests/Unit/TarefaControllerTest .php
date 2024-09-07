<?php

namespace Tests\Feature;

use App\Models\Tarefa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Tests\TestCase;

class TarefaControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * Testa a criação de uma nova tarefa.
     *
     * @return void
     */
    public function testStore()
    {
        $response = $this->post('/tarefas', [
            'titulo' => 'Nova Tarefa',
            'descricao' => 'Descrição da nova tarefa',
            'status' => 'pendente',
        ]);

        $response->assertRedirect('/tarefas');
        $response->assertSessionHas('success', 'Tarefa criada com sucesso!');

        $this->assertDatabaseHas('tarefas', [
            'titulo' => 'Nova Tarefa',
            'descricao' => 'Descrição da nova tarefa',
            'status' => 'pendente',
        ]);
    }

    /**
     * Testa a atualização de uma tarefa existente.
     *
     * @return void
     */
    public function testUpdate()
    {
        $tarefa = Tarefa::create([
            'titulo' => 'Tarefa Antiga',
            'descricao' => 'Descrição antiga',
            'status' => 'pendente',
        ]);

        $response = $this->put('/tarefas/' . $tarefa->id, [
            'titulo' => 'Tarefa Atualizada',
            'descricao' => 'Descrição atualizada',
            'status' => 'concluída',
        ]);

        $response->assertRedirect('/tarefas');
        $response->assertSessionHas('success', 'Tarefa atualizada com sucesso!');

        $this->assertDatabaseHas('tarefas', [
            'titulo' => 'Tarefa Atualizada',
            'descricao' => 'Descrição atualizada',
            'status' => 'concluída',
        ]);
    }

    /**
     * Testa a exclusão de uma tarefa existente.
     *
     * @return void
     */
    public function testDelete()
    {
        $tarefa = Tarefa::create([
            'titulo' => 'Tarefa a ser excluída',
            'descricao' => 'Descrição da tarefa a ser excluída',
            'status' => 'pendente',
        ]);

        $response = $this->delete('/tarefas/' . $tarefa->id);

        $response->assertRedirect('/tarefas');
        $response->assertSessionHas('success', 'Tarefa excluída com sucesso!');

        $this->assertDatabaseMissing('tarefas', [
            'titulo' => 'Tarefa a ser excluída',
            'descricao' => 'Descrição da tarefa a ser excluída',
            'status' => 'pendente',
        ]);
    }
}
