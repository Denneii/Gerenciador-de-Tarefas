<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Gerenciador de Tarefas</h1>

        <!-- Formulário para adicionar nova tarefa -->
        <div class="card mb-4">
            <div class="card-header">Nova Tarefa</div>
            <div class="card-body">
                <form action="{{ route('tarefas.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição da Tarefa</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" required>
                    </div>
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="pendente">Pendente</option>
                            <option value="concluida">Concluída</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Tarefa</button>
                </form>
            </div>
        </div>

        <!-- Lista de tarefas -->
        <div class="card">
            <div class="card-header">Lista de Tarefas</div>
            <div class="card-body">
                @if($tarefas->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Descrição</th>
                                <th>Titulo</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tarefas as $tarefa)
                                <tr>
                                    <td>{{ $tarefa->id }}</td>
                                    <td>{{ $tarefa->descricao }}</td>
                                    <td>{{ $tarefa->titulo }}</td>
                                    <td>{{ ucfirst($tarefa->status) }}</td>
                                    <td>
                                        <!-- Botão de Editar -->
                                        <a href="{{ route('tarefas.edit', $tarefa->id) }}" class="btn btn-warning btn-sm">Editar</a>

                                        <!-- Formulário para Excluir -->
                                        <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">Nenhuma tarefa encontrada.</p>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
